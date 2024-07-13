<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/
defined('_JEXEC') or die('No Access');
if(!defined('THUMB_CACHE')) {
    define('THUMB_CACHE', './cache/thumbs/');    // Path to cache directory (must be writeable)
    define('THUMB_CACHE_AGE', 2592000);         // Duration of cached files in seconds
    define('THUMB_BROWSER_CACHE', true);          // Browser cache true or false
    define('ADJUST_ORIENTATION', true);          // Auto adjust orientation for JPEG true or false
}
if (!class_exists('RuxinFunctions')) {
    class RuxinFunctions
    {
        public function thumb($src, $width, $height)
        {
            if ($src && $src != "/") {
                $folder_path = realpath(THUMB_CACHE);
                if ($folder_path == false && !is_dir($folder_path)) {
                    mkdir(THUMB_CACHE);
                }
                if ($height == 'auto') {
                    list($w0, $h0, $type) = getimagesize($src);
                    $height = floor($h0 * ($width / $w0));
                }

                $size = $width . 'x' . $height;
                $crop = isset($_GET['crop']) ? max(0, min(1, $_GET['crop'])) : 1;
                $trim = 1;//isset($_GET['trim']) ? max(0, min(1, $_GET['trim'])) : 0;
                $zoom = 1;//isset($_GET['zoom']) ? max(0, min(1, $_GET['zoom'])) : 1;
                $path = parse_url($src);
                if (isset($path['scheme'])) {
                    $base = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                    if (preg_replace('/^www\./i', '', $base['host']) == preg_replace('/^www\./i', '', $path['host'])) {
                        $base = explode('/', preg_replace('/\/+/', '/', $base['path']));
                        $path = explode('/', preg_replace('/\/+/', '/', $path['path']));
                        $temp = $path;
                        $part = count($base);
                        foreach ($base as $k => $v) {
                            if ($v == $path[$k]) {
                                array_shift($temp);
                            } else {
                                if ($part - $k > 1) {
                                    $temp = array_pad($temp, 0 - (count($temp) + ($part - $k) - 1), '..');
                                    break;
                                } else {
                                    $temp[0] = './' . $temp[0];
                                }
                            }
                        }
                        $src = implode('/', $temp);
                    }
                }
                if (!extension_loaded('gd')) {
                    $error = 'GD extension is not installed';
                }
                if (!is_writable(THUMB_CACHE)) {
                    $error = 'Cache not writable';
                }
                if (isset($path['scheme']) || !file_exists($src)) {
                    $error = 'File cannot be found';
                }
                if (!in_array(strtolower(substr(strrchr($src, '.'), 1)), array('gif', 'jpg', 'jpeg', 'png'))) {
                    $error = 'File is not an image';
                }
                $file_salt = 'v1.0.4';

                if (strpos($src , 'http://') !== false || strpos($src , 'https://') !== false) {
                    $file_size = 1;
                    $file_time = 1;
                } else {
                    $file_size = filesize($src);
                    $file_time = filemtime($src);
                }
                $file_date = gmdate('D, d M Y H:i:s T', $file_time);
                $file_type = strtolower(substr(strrchr($src, '.'), 1));
                $file_hash = md5($file_salt . ($src . $size . $crop . $trim . $zoom) . $file_time);
                $file_temp = THUMB_CACHE . $file_hash . '.' . $file_type;
                $file_name = basename(substr($src, 0, strrpos($src, '.')) . strtolower(strrchr($src, '.')));
                if (!file_exists(THUMB_CACHE . 'index.html')) {
                    touch(THUMB_CACHE . 'index.html');
                }
                if (($fp = fopen(THUMB_CACHE . 'index.html', 'r')) !== false) {
                    if (flock($fp, LOCK_EX)) {
                        if (time() - THUMB_CACHE_AGE > filemtime(THUMB_CACHE . 'index.html')) {
                            $files = glob(THUMB_CACHE . '*.img.txt');
                            if (is_array($files) && count($files) > 0) {
                                foreach ($files as $file) {
                                    if (time() - THUMB_CACHE_AGE > filemtime($file)) {
                                        unlink($file);
                                    }
                                }
                            }
                            touch(THUMB_CACHE . 'index.html');
                        }
                        flock($fp, LOCK_UN);
                    }
                    fclose($fp);
                }
                if (THUMB_BROWSER_CACHE && (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH']))) {
                    if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $file_date && $_SERVER['HTTP_IF_NONE_MATCH'] == $file_hash) {
                        header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                        //die();
                    }
                }
                if (!file_exists($file_temp)) {
                    list($w0, $h0, $type) = getimagesize($src);
                    $data = file_get_contents($src);
                    if ($type == 1) {
                        if (preg_match('/\x00\x21\xF9\x04.{4}\x00(\x2C|\x21)/s', $data)) {
                            header('Content-Type: image/gif');
                            header('Content-Length: ' . $file_size);
                            header('Content-Disposition: inline; filename="' . $file_name . '"');
                            header('Last-Modified: ' . $file_date);
                            header('ETag: ' . $file_hash);
                            header('Accept-Ranges: none');
                            if (THUMB_BROWSER_CACHE) {
                                header('Cache-Control: max-age=604800, must-revalidate');
                                header('Expires: ' . gmdate('D, d M Y H:i:s T', strtotime('+7 days')));
                            } else {
                                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                                header('Expires: ' . gmdate('D, d M Y H:i:s T'));
                                header('Pragma: no-cache');
                            }
                            die($data);
                        }
                    }
                    $oi = imagecreatefromstring($data);
                    list($w, $h) = explode('x', str_replace('<', '', $size) . 'x');
                    $w = ($w != '') ? floor(max(8, min(1500, $w))) : '';
                    $h = ($h != '') ? floor(max(8, min(1500, $h))) : '';
                    if (strstr($size, '<')) {
                        $h = $w;
                        $crop = 0;
                        $trim = 1;
                    } elseif (!strstr($size, 'x')) {
                        $h = $w;
                    } elseif ($w == '' || $h == '') {
                        $w = ($w == '') ? ($w0 * $h) / $h0 : $w;
                        $h = ($h == '') ? ($h0 * $w) / $w0 : $h;
                        $crop = 0;
                        $trim = 1;
                    }
                    $trim_w = ($trim) ? 1 : ($w == '') ? 1 : 0;
                    $trim_h = ($trim) ? 1 : ($h == '') ? 1 : 0;
                    if ($crop) {
                        $w1 = (($w0 / $h0) > ($w / $h)) ? floor($w0 * $h / $h0) : $w;
                        $h1 = (($w0 / $h0) < ($w / $h)) ? floor($h0 * $w / $w0) : $h;
                        if (!$zoom) {
                            if ($h0 < $h || $w0 < $w) {
                                $w1 = $w0;
                                $h1 = $h0;
                            }
                        }
                    } else {
                        $w1 = (($w0 / $h0) < ($w / $h)) ? floor($w0 * $h / $h0) : floor($w);
                        $h1 = (($w0 / $h0) > ($w / $h)) ? floor($h0 * $w / $w0) : floor($h);
                        $w = floor($w);
                        $h = floor($h);
                        if (!$zoom) {
                            if ($h0 < $h && $w0 < $w) {
                                $w1 = $w0;
                                $h1 = $h0;
                            }
                        }
                    }
                    $w = ($trim_w) ? (($w0 / $h0) > ($w / $h)) ? min($w, $w1) : $w1 : $w;
                    $h = ($trim_h) ? (($w0 / $h0) < ($w / $h)) ? min($h, $h1) : $h1 : $h;
                    $x = ($w - $w1) / 2;
                    $y = ($h - $h1) / 2;
                    $im = imagecreatetruecolor($w, $h);
                    $bg = imagecolorallocate($im, 0, 0, 0);
                    imagefill($im, 0, 0, $bg);
                    switch ($type) {
                        case 1:
                            imagecopyresampled($im, $oi, $x, $y, 0, 0, $w1, $h1, $w0, $h0);
                            imagegif($im, $file_temp);
                            break;
                        case 2:
                            imagecopyresampled($im, $oi, $x, $y, 0, 0, $w1, $h1, $w0, $h0);
                            imagejpeg($im, $file_temp, 70);
                            break;
                        case 3:
                            imagefill($im, 0, 0, imagecolorallocatealpha($im, 0, 0, 0, 127));
                            imagesavealpha($im, true);
                            imagealphablending($im, false);
                            imagecopyresampled($im, $oi, $x, $y, 0, 0, $w1, $h1, $w0, $h0);
                            imagepng($im, $file_temp);
                            break;
                    }
                    imagedestroy($im);
                    imagedestroy($oi);
                }
                return "./cache/thumbs/" . $file_hash . '.' . $file_type;
            } else {
                if (!file_exists('./cache/thumbs/no-image.png')) {
                }
                return "./modules/mod_ruxin_news/includes/images/no-image.jpg";
            }
        }

        public function trimText($text, $limit, $type, $replace)
        {
            $text = strip_tags($text);
            if ($type == "char") {
                if (strlen($text) > $limit && $limit > 0) {
                    $text = mb_substr($text, 0, $limit) . $replace;
                    return $text;
                } else
                    return $text;
            } else {
                $text_array = explode(' ', $text);
                if (count($text_array) > $limit && $limit > 0) {
                    $text = implode(' ', array_slice($text_array, 0, $limit)) . $replace;
                    return $text;
                } else
                    return $text;
            }
        }

        /*
         ********************
         * Grab image for Thumbs
         ********************
         */
        public function parsImage($list, $params)
        {
            $source = $params->get('source');
            $image_source = $params->get('image_source');

            $lead_width = $params->get('lead_thumbnail_width', 100);
            $lead_height = $params->get('lead_thumbnail_height', 100);

            $intro_width = $params->get('intro_thumbnail_width', 100);
            $intro_height = $params->get('intro_thumbnail_height', 100);

            $link_width = $params->get('link_thumbnail_width', 100);
            $link_height = $params->get('link_thumbnail_height', 100);

            $images = array();
            foreach ($list as $key => $item) :
                if ($image_source == "intro_image") {
                    if ($source == 'k2_category') {
                        if (file_exists('media/k2/items/cache/' . md5("Image" . $item->id) . '_M.jpg')) {
                            //$image[1] = JURI::root() . '/media/k2/items/cache/' . md5("Image" . $item->id) . '_M.jpg';
							$image[1] = 'media/k2/items/cache/' . md5("Image" . $item->id) . '_M.jpg';
                        } else {
                            $image[1] = "./modules/mod_ruxin_news/includes/images/no-image.jpg";
                        }
                        $lead = $this->thumb($image[1], $lead_width, $lead_height);
                        $intro = $this->thumb($image[1], $intro_width, $intro_height);
                        $link = $this->thumb($image[1], $link_width, $link_height);
                        array_push($images, array('key' => $key, "lead_thumb" => $lead, "intro_thumb" => $intro, "link_thumb" => $link));

                    } else {
                        $imagej = json_decode($item->images);
                        if ($imagej->image_intro) {
                            $intro = $this->thumb($imagej->image_intro, $intro_width, $intro_height);
                            $lead = $this->thumb($imagej->image_intro, $lead_width, $lead_height);
                            array_push($images, array('key' => $key, "lead_thumb" => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                        } else {
                            $lead = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $lead_width, $lead_height);
                            $intro = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $intro_width, $intro_height);
                            $link = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $link_width, $link_height);
                            array_push($images, array('key' => $key, 'lead_thumb' => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                        }
                    }
                } else if ($image_source == "fulltext") {
                    $fulltext = $item->introtext . $item->fulltext;
                    preg_match('/<img .*?(?=src)src=\"([^\"]+)\"/si', $fulltext, $image);
                    if (isset($image[1])) {
                        $intro = $this->thumb($image[1], $intro_width, $intro_height);
                        $lead = $this->thumb($image[1], $lead_width, $lead_height);
                        $link = $this->thumb($image[1], $link_width, $link_height);
                        array_push($images, array('key' => $key, "lead_thumb" => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                    } else {
                        $lead = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $lead_width, $lead_height);
                        $intro = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $intro_width, $intro_height);
                        $link = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $link_width, $link_height);
                        array_push($images, array('key' => $key, 'lead_thumb' => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                    }
                } else { // Auto - First intro
                    $imagej = json_decode($item->images);
                    if ($imagej->image_intro) {
                        $lead = $this->thumb($imagej->image_intro, $lead_width, $lead_height);
                        $intro = $this->thumb($imagej->image_intro, $intro_width, $intro_height);
                        $link = $this->thumb($imagej->image_intro, $link_width, $link_height);
                        array_push($images, array('key' => $key, "lead_thumb" => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                    } else {
                        $fulltext = $item->introtext . $item->fulltext;
                        preg_match('/<img .*?(?=src)src=\"([^\"]+)\"/si', $fulltext, $image);
                        if (isset($image[1])) {
                            $lead = $this->thumb($image[1], $lead_width, $lead_height);
                            $intro = $this->thumb($image[1], $intro_width, $intro_height);
                            $link = $this->thumb($image[1], $link_width, $link_height);
                            array_push($images, array('key' => $key, "lead_thumb" => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                        } else {
                            $lead = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $lead_width, $lead_height);
                            $intro = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $intro_width, $intro_height);
                            $link = $this->thumb("./modules/mod_ruxin_news/includes/images/no-image.jpg", $link_width, $link_height);
                            array_push($images, array('key' => $key, 'lead_thumb' => $lead, "intro_thumb" => $intro, "link_thumb" => $link));
                        }
                    }
                }
            endforeach;
            return $images;
        }
    }
}

?>