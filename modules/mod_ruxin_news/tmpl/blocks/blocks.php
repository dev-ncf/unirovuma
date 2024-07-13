<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/
defined('_JEXEC') or die;

$block = $params->get('block', '1');
if ($block != "custom") {
	
	// Block 1 Setting
	if ($block == 1) {
		$params->set('gap', 3);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 4);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 2);
		
		$params->set('lead_width', '50%');
		$params->set('intro_width', '50%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);

		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 426);

		$params->set('intro_thumbnail_width', 400);
		$params->set('intro_thumbnail_height', 210);
		
	// Block 2 Setting
	} else if ($block == 2) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 2);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 2);
		
		$params->set('lead_width', '50%');
		$params->set('intro_width', '50%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 650);
		$params->set('lead_thumbnail_height', 380);

		$params->set('intro_thumbnail_width', 300);
		$params->set('intro_thumbnail_height', 380);
		
	// Block 3 Setting
	} else if ($block == 3) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 2);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		$params->set('intro_column', 1);
		$params->set('link_column', 0);
		
		$params->set('lead_width', '50%');
		$params->set('intro_width', '50%');
		$params->set('link_width', '0');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 300);
		$params->set('lead_thumbnail_height', 488);

		$params->set('intro_thumbnail_width', 600);
		$params->set('intro_thumbnail_height', 240);
		
	// Block 4 Setting
	} else if ($block == 4) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 2);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		$params->set('link_column', 0);
		
		$params->set('lead_width', '60%');
		$params->set('intro_width', '40%');
		$params->set('link_width', '0');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 700);
		$params->set('lead_thumbnail_height', 468);

		$params->set('intro_thumbnail_width', 550);
		$params->set('intro_thumbnail_height', 230);
		
	// Block 5 Setting
	} else if ($block == 5) {
		$params->set('gap', 8);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 4);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 2);
		
		$params->set('lead_width', '50%');
		$params->set('intro_width', '50%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);

		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 650);
		$params->set('lead_thumbnail_height', 476);

		$params->set('intro_thumbnail_width', 400);
		$params->set('intro_thumbnail_height', 230);
		
	// Block 6 Setting
	} else if ($block == 6) {
		$params->set('gap', 3);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 3);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		$params->set('link_column', 0);
		
		$params->set('lead_width', '65%');
		$params->set('intro_width', '35%');
		$params->set('link_width', '0');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 800);
		$params->set('lead_thumbnail_height', 552);

		$params->set('intro_thumbnail_width', 400);
		$params->set('intro_thumbnail_height', 180);

		
	// Block 7 Setting
	} else if ($block == 7) {
		$params->set('gap', 5);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 650);
		$params->set('lead_thumbnail_height', 400);
		
	// Block 8 Setting
	} else if ($block == 8) {
		$params->set('gap', 5);
		
		$params->set('lead_count', 3);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 3);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 450);
		$params->set('lead_thumbnail_height', 500);
		
	// Block 9 Setting
	} else if ($block == 9) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 5);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		$params->set('intro_column', 5);
		
		$params->set('lead_width', '100%');
		$params->set('intro_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		$params->set('intro_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 650);
		$params->set('lead_thumbnail_height', 340);

		$params->set('intro_thumbnail_width', 250);
		$params->set('intro_thumbnail_height', 180);
		
	// Block 10 Setting
	} else if ($block == 10) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 3);
		$params->set('intro_count', 4);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 3);
		$params->set('intro_column', 4);
		
		$params->set('lead_width', '100%');
		$params->set('intro_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 480);
		$params->set('lead_thumbnail_height', 280);

		$params->set('intro_thumbnail_width', 300);
		$params->set('intro_thumbnail_height', 180);
		
	// Block 11 Setting
	} else if ($block == 11) {
		$params->set('gap', 5);
		
		$params->set('lead_count', 4);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 4);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 350);
		$params->set('lead_thumbnail_height', 450);
		
	// Block 12 Setting
	} else if ($block == 12) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 4);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		$params->set('link_column', 0);
		
		$params->set('lead_width', '55%');
		$params->set('intro_width', '45%');
		$params->set('link_width', '0');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('intro_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('intro_image_align', 'right');
		} else {
			$params->set('intro_image_align', 'left');
		}
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 395);

		$params->set('intro_thumbnail_width', 120);
		$params->set('intro_thumbnail_height', 80);
		
	// Block 13 Setting
	} else if ($block == 13) {
		$params->set('gap', 2);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 1);
		$params->set('link_count', 2);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		$params->set('link_column', 1);
		
		$params->set('lead_width', '30%');
		$params->set('intro_width', '40%');
		$params->set('link_width', '30%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		$params->set('show_link_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('link_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 350);
		$params->set('lead_thumbnail_height', 220);

		$params->set('intro_thumbnail_width', 700);
		$params->set('intro_thumbnail_height', 444);

		$params->set('link_thumbnail_width', 350);
		$params->set('link_thumbnail_height', 220);
		
	// Block 14 Setting
	} else if ($block == 14) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
				
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image
		
		if($lang->get('rtl')) {
			$params->set('lead_image_align', 'right');
		} else {
			$params->set('lead_image_align', 'left');
		}
		
		$params->set('lead_text_center', '0');

		$params->set('lead_thumbnail_width', 100);
		$params->set('lead_thumbnail_height', 80);
		
	// Block 15 Setting
	} else if ($block == 15) {
		$params->set('gap', 20);
		
		$params->set('lead_count', 4);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 250);
		
		$params->set('lead_text_center', '1');
		
	// Block 16 Setting
	} else if ($block == 16) {
		$params->set('gap', 20);
		
		$params->set('lead_count', 6);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 3);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 400);
		$params->set('lead_thumbnail_height', 250);
		
		$params->set('lead_text_center', '1');		
		
	// Block 17 Setting
	} else if ($block == 17) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 6);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		
		$params->set('lead_width', '60%');
		$params->set('intro_width', '40%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 0);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('intro_text_center', '0');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 800);
		$params->set('lead_thumbnail_height', 450);
		
	// Block 18 Setting
	} else if ($block == 18) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 1);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		
		$params->set('lead_width', '100%');
		$params->set('intro_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('intro_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('intro_image_align', 'right');
		} else {
			$params->set('intro_image_align', 'left');
		}
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 1100);
		$params->set('lead_thumbnail_height', 350);

		$params->set('intro_thumbnail_width', 250);
		$params->set('intro_thumbnail_height', 150);
		
	// Block 19 Setting
	} else if ($block == 19) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 4);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 2);
		
		$params->set('lead_width', '100%');
		$params->set('intro_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('intro_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('intro_image_align', 'right');
		} else {
			$params->set('intro_image_align', 'left');
		}
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 1100);
		$params->set('lead_thumbnail_height', 350);

		$params->set('intro_thumbnail_width', 150);
		$params->set('intro_thumbnail_height', 90);
		
	// Block 20 Setting
	} else if ($block == 20) {
		$params->set('gap', 20);
		
		$params->set('lead_count', 4);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_center', '0');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 250);
		
	// Block 21 Setting
	} else if ($block == 21) {
		$params->set('gap', 0);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_center', '1');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		
		$params->set('lead_text_center', '1');
		
		$params->set('lead_thumbnail_width', 1100);
		$params->set('lead_thumbnail_height', 400);

		
	// Block 22 Setting
	} else if ($block == 22) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('lead_image_align', 'right');
		} else {
			$params->set('lead_image_align', 'left');
		}
				
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 350);
		$params->set('lead_thumbnail_height', 450);
		
	// Block 23 Setting
	} else if ($block == 23) {
		$params->set('gap', 8);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 5);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 1);
		
		$params->set('lead_width', '50%');
		$params->set('intro_width', '50%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('intro_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('intro_image_align', 'right');
		} else {
			$params->set('intro_image_align', 'left');
		}

		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 508);

		$params->set('intro_thumbnail_width', 130);
		$params->set('intro_thumbnail_height', 80);
		
	// Block 24 Setting
	} else if ($block == 24) {
		$params->set('gap', 15);
		
		$params->set('lead_count', 4);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 300);
		
	// Block 25 Setting
	} else if ($block == 25) {
		$params->set('gap', 15);
		
		$params->set('lead_count', 2);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 600);
		$params->set('lead_thumbnail_height', 650);

		
	// Block 26 Setting
	} else if ($block == 26) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 8);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_text_center', '0');
		
		if($lang->get('rtl')) {
			$params->set('lead_image_align', 'right');
		} else {
			$params->set('lead_image_align', 'left');
		}
		
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 130);
		$params->set('lead_thumbnail_height', 80);

		
	// Block 27 Setting
	} else if ($block == 27) {
		$params->set('gap', 10);
		
		$params->set('lead_count', 8);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 2);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 0);
		
		$params->set('lead_text_center', '0');
		
		$params->set('lead_text_type', 'news_normal'); //news_normal || news_on_image

	// Block 28 Setting
	} else if ($block == 28) {
		$params->set('gap', 4);
		
		$params->set('lead_count', 1);
		$params->set('intro_count', 3);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		$params->set('intro_column', 3);
		
		$params->set('lead_width', '100%');
		$params->set('intro_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		$params->set('show_intro_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('intro_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 1100);
		$params->set('lead_thumbnail_height', 390);

		$params->set('intro_thumbnail_width', 400);
		$params->set('intro_thumbnail_height', 180);
		
	// Block 29 Setting
	} else if ($block == 29) {
		$params->set('gap', 0);
		
		$params->set('lead_count', 5);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 1);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image
		$params->set('image_hover_effect', 'news_hover_effect_off');

		$params->set('lead_thumbnail_width', 1100);
		$params->set('lead_thumbnail_height', 450);
		
	// Block 30 Setting
	} else if ($block == 30) {
		$params->set('gap', 0);
		
		$params->set('lead_count', 6);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 3);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 400);
		$params->set('lead_thumbnail_height', 240);
		
	// Block 31 Setting
	} else if ($block == 31) {
		$params->set('gap', 0);
		
		$params->set('lead_count', 8);
		$params->set('intro_count', 0);
		$params->set('link_count', 0);
		
		$params->set('lead_column', 4);
		
		$params->set('lead_width', '100%');
		
		$params->set('show_lead_thumbnail', 1);
		
		$params->set('lead_image_align', 'none');
		
		$params->set('lead_text_type', 'news_on_image'); //news_normal || news_on_image

		$params->set('lead_thumbnail_width', 300);
		$params->set('lead_thumbnail_height', 200);
		
	}
}
