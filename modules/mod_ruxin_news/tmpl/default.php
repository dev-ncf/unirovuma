<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/
defined('_JEXEC') or die;
$doc = JFactory::getDocument();

// Get Block
$block = $params->get('block', '1');

/**---------------
 * Add CSS & JS to document
 * ----------------------**/
 
if ($block == '29') $doc->addScript(JURI::root() . 'modules/mod_ruxin_news/includes/js/owl.carousel.min.js');
$doc->addStyleSheet(JURI::root() . 'modules/mod_ruxin_news/includes/css/ruxin_news.css');
if ($block == '29')$doc->addStyleSheet(JURI::root() . 'modules/mod_ruxin_news/includes/css/owl.carousel.min.css');
if ($block == '29')$doc->addStyleSheet(JURI::root() . 'modules/mod_ruxin_news/includes/css/owl.theme.green.css');

$lang = JFactory::getLanguage();
if($lang->get('rtl')) $doc->addStyleSheet(JURI::root() . 'modules/mod_ruxin_news/includes/css/ruxin_news_rtl.css');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

//require 'blocks/blocks.php';

$functions = new RuxinFunctions;
$images = $functions->parsImage($list, $params);
$source = $params->get('source');

// Global Params
$lead_count = $params->get('lead_count', 0);
$intro_count = $params->get('intro_count', 0);
$link_count = $params->get('link_count', 0);
$count = $lead_count + $intro_count + $link_count;
$list_count = count($list);
$news_type = $params->get('news_type', "news");

$show_heading = $params->get('show_heading', 0);
$heading_text = $params->get('heading_text', "");
$heading_link = $params->get('heading_link', "");
$heading_style = $params->get('heading_style', 1);
$heading_text_color = $params->get('heading_text_color', "#ffffff");
$heading_background_color = $params->get('heading_background_color', "#000000");
$heading_font_size = $params->get('heading_font_size', "14");
$gap = $params->get('gap', "3");
$black_background = $params->get('black_background', 0);

$image_hover_effect = $params->get('image_hover_effect', 'news_hover_effect_on');

$heading_margin_bottom = $params->get('heading_margin_bottom', 15);

$lead_category_color = $params->get('lead_category_color', '#ffffff');
$lead_category_background = $params->get('lead_category_background', '#ec0000');

$intro_category_color = $params->get('intro_category_color', '#ffffff');
$intro_category_background = $params->get('intro_category_background', '#ec0000');

$link_category_color = $params->get('link_category_color', '#ffffff');
$link_category_background = $params->get('link_category_background', '#ec0000');

$source = $params->get('source', 'category');

$show_load_more = $params->get('show_load_more', 0);
$load_more_type = $params->get('load_more_type', 'next_prev');
$load_more_text = $params->get('load_more_text', 'Load More');
$no_more_text = $params->get('no_more_text', 'No More Articles');
$load_more_next_text = $params->get('load_more_next_text', 'Next');
$load_more_prev_text = $params->get('load_more_prev_text', 'Prev');

?>

<?php if ($show_heading) { ?>
<div id="ruxin_news_heading<?php echo $module->id; ?>" class="ruxin_news_heading<?php echo $heading_style; ?>">
	<?php if (!empty($heading_link)) { ?>
		<h4 class="news_module_title"><a href="<?php echo $heading_link; ?>"><?php echo $heading_text; ?></a></h4>
	<?php } else { ?>
		<h4 class="news_module_title"><span><?php echo $heading_text; ?></span></h4>
	<?php } ?>
</div>
<?php } ?>
<div class="ruxin_news news-block-<?php echo $block; ?>" id="ruxin_news_<?php echo $module->id ?>">
    <?php
    // News Layout
	$leading_type = "leading";
	if ($block == '29') $leading_type = "slider";
    if ($lead_count && $list_count > 0) {
        require dirname(__FILE__) . '/blocks/'.$leading_type.'.php';
        $list_count -= $lead_count;
    }

    if ($intro_count && $list_count > 0) {
       require dirname(__FILE__) . '/blocks/intro.php';
       $list_count -= $intro_count;
    }

   if ($link_count && $list_count > 0) {
       require dirname(__FILE__) . '/blocks/link.php';
    }
    ?>
</div>


<?php if ($show_load_more && $block != '29') { ?>
	<div id="ruxin_news_<?php echo $module->id ?>_load_more_section" class="ruxin_load_more_section">
	
	<?php if ($load_more_type == "next_prev") { ?>
		<button id="load_more_<?php echo $module->id; ?>" class="prev_page" disabled><?php echo $load_more_prev_text; ?></button>
		<button id="load_more_<?php echo $module->id; ?>" class="next_page"><?php echo $load_more_next_text; ?></button>
	<?php } else { ?>
		<button id="load_more_<?php echo $module->id; ?>"><?php echo $load_more_text; ?></button>
	<?php } ?>
		<img class="ruxin_loading_image ruxin_hidden" src="<?php echo JURI::root(); ?>modules/mod_ruxin_news/includes/images/loading.gif" width="60" height="60" />
		<span class="ruxin_no_more_articles ruxin_hidden"><?php echo $no_more_text; ?></span>
	</div>

	<?php if ($load_more_type == "next_prev") { ?>
		<script>
			var page<?php echo $module->id; ?> = 0;
			var pageURL = jQuery(location).attr("href");
			if (~pageURL.indexOf("?")) { var page_type = "&"; } else { var page_type = "?"; }
			jQuery(document).on('click', '#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>', function () {
				jQuery('#load_more_<?php echo $module->id; ?>.prev_page, #load_more_<?php echo $module->id; ?>.next_page').hide();
				jQuery("#ruxin_news_<?php echo $module->id ?>").css("opacity", "0.4");
				jQuery("#ruxin_news_<?php echo $module->id ?>_load_more_section .ruxin_loading_image").removeClass('ruxin_hidden');
				if (jQuery(this).attr("class") == "next_page") {
					page<?php echo $module->id; ?> += 1;
				} else if (page<?php echo $module->id; ?> > 0) {
					page<?php echo $module->id; ?> -= 1;
				}
				jQuery.get(pageURL + page_type + "page=" + page<?php echo $module->id; ?> + "#ruxin_news_<?php echo $module->id; ?>", function (data) {
					var data = jQuery(data).find('#ruxin_news_<?php echo $module->id; ?>').html();
					jQuery('#ruxin_news_<?php echo $module->id ?>_load_more_section .ruxin_loading_image').addClass('ruxin_hidden');
					if (!jQuery.trim(data)) {
						jQuery("#ruxin_news_<?php echo $module->id ?>").css("opacity", "1");
						jQuery("#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.next_page, #ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.prev_page").show();	
						jQuery('#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.next_page').prop("disabled", true);
						page<?php echo $module->id; ?> -= 1;
					} else {
						jQuery('#ruxin_news_<?php echo $module->id; ?>').html(data);
						jQuery("#ruxin_news_<?php echo $module->id ?>").css("opacity", "1");
						jQuery("#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.next_page, #ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.prev_page").show();		
						jQuery('#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.next_page').prop("disabled", false);
	
					}

					if (page<?php echo $module->id; ?> > 0) {
						jQuery('#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.prev_page').prop("disabled", false);
					} else {
						jQuery('#ruxin_news_<?php echo $module->id ?>_load_more_section #load_more_<?php echo $module->id; ?>.prev_page').prop("disabled", true);
					}
				});
			});
		</script>
	<?php } else { ?>
		<script>
			var page<?php echo $module->id; ?> = 0;
			var pageURL = jQuery(location).attr("href");
			if (~pageURL.indexOf("?")) { var page_type = "&"; } else { var page_type = "?"; }
			jQuery(document).on('click', '#ruxin_news_<?php echo $module->id; ?>_load_more_section #load_more_<?php echo $module->id; ?>', function () {
				jQuery(this).hide();
				jQuery("#ruxin_news_<?php echo $module->id; ?>_load_more_section .ruxin_loading_image").removeClass('ruxin_hidden');
				page<?php echo $module->id; ?> += 1;
				jQuery.get(pageURL + page_type + "page=" + page<?php echo $module->id; ?> + "#ruxin_news_<?php echo $module->id; ?>", function (data) {
					var data = jQuery(data).find('#ruxin_news_<?php echo $module->id; ?>').html();
					jQuery('#ruxin_news_<?php echo $module->id; ?>_load_more_section .ruxin_loading_image').addClass('ruxin_hidden');
					if (!jQuery.trim(data)) {
						jQuery(this).remove();
						jQuery('#ruxin_news_<?php echo $module->id; ?>_load_more_section .ruxin_no_more_articles').removeClass("ruxin_hidden");
						setTimeout(function () {
							jQuery('#ruxin_news_<?php echo $module->id; ?>_load_more_section .ruxin_no_more_articles').addClass("ruxin_hidden");
						}, 3000);
					} else {
						jQuery('#ruxin_news_<?php echo $module->id; ?>').append(data);
						jQuery("#ruxin_news_<?php echo $module->id; ?>_load_more_section #load_more_<?php echo $module->id; ?>").show();
					}
				});
			});
		</script>
	<?php } ?>
<?php } ?>

<style>
<?php if ($black_background) { ?>
#ruxin_news_<?php echo $module->id ?> {
	background-color: #000000;
	margin: 0 !important;
}
<?php } ?>

#ruxin_news_<?php echo $module->id ?> {
	margin: 0 -<?php echo $gap; ?>px;
}

#ruxin_news_<?php echo $module->id ?> .ruxin-news-col-1, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-2, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-3, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-4, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-5, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-6, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-7, #ruxin_news_<?php echo $module->id ?> .ruxin-news-col-8 {
    padding: <?php echo $gap; ?>px;
}

#ruxin_news_heading<?php echo $module->id; ?> .news_module_title a, #ruxin_news_heading<?php echo $module->id; ?> .news_module_title span {
	color: <?php echo $heading_text_color; ?>;
	background-color: <?php echo $heading_background_color; ?>;
	font-size: <?php echo $heading_font_size; ?>px;
}

#ruxin_news_heading<?php echo $module->id; ?> .news_module_title {
	border-color: <?php echo $heading_background_color; ?>;
}

#ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading2 .news_module_title > ::before {
    left: 10px;
    border-color: <?php echo $heading_background_color; ?> transparent transparent transparent;
}

#ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading3 .news_module_title, #ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading4 .news_module_title {
	border-color: <?php echo $heading_background_color; ?>;
}

#ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading4 .news_module_title a, #ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading4 .news_module_title span {
	border-color: <?php echo $heading_text_color; ?>;
}
 
#ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading6 .news_module_title {
	 border-color: <?php echo $heading_text_color; ?>;
}
 
#ruxin_news_heading<?php echo $module->id; ?>.ruxin_news_heading6 .news_module_title::before {
	 border-color: <?php echo $heading_background_color; ?>;
	 background-color: <?php echo $heading_background_color; ?>;
}

.ruxin_news_heading6 .news_module_title::after {
	 border-color: <?php echo $heading_background_color; ?> transparent transparent transparent;
}

#ruxin_news_heading<?php echo $module->id; ?> .news_module_title {
	margin-bottom: <?php echo $heading_margin_bottom; ?>px;
}

#ruxin_news_<?php echo $module->id ?> .lead_category_top {
	background: <?php echo $lead_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .lead_category_top::before {
	border-top: 5px solid <?php echo $lead_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .lead_category_top a {
	color: <?php echo $lead_category_color; ?>;
}

#ruxin_news_<?php echo $module->id ?> .lead_category a {
	color: <?php echo $lead_category_color; ?>;
	background: <?php echo $lead_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .intro_category_top {
	background: <?php echo $intro_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .intro_category_top::before {
	border-top: 5px solid <?php echo $intro_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .intro_category_top a {
	color: <?php echo $intro_category_color; ?>;
}

#ruxin_news_<?php echo $module->id ?> .intro_category a {
	color: <?php echo $intro_category_color; ?>;
	background: <?php echo $intro_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .link_category_top {
	background: <?php echo $link_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .link_category_top::before {
	border-top: 5px solid <?php echo $link_category_background; ?>;
}

#ruxin_news_<?php echo $module->id ?> .link_category_top a {
	color: <?php echo $link_category_color; ?>;
}

#ruxin_news_<?php echo $module->id ?> .link_category a {
	color: <?php echo $link_category_color; ?>;
	background: <?php echo $link_category_background; ?>;
}
</style>


