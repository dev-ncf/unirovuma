<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/


//Restrict direct access
defined('_JEXEC') or die('Restricted access');

class modRuxinNewsHelper
{

    public static function getList(&$params)
    {

        //Get source form params
        $source = $params->get('source', 'category');

        if ($source == 'category') {
            $source = 'joomla';
        } else {
            $source = 'k2';
        }

        $path = JPATH_SITE . '/modules/mod_ruxin_news/classes/' . $source . ".php";
        require_once $path;
        $className = "Ruxin" . $source . "ContentSource";
        $object = new $className($params);
        $items = $object->getList();
        return $items;

    }
}
