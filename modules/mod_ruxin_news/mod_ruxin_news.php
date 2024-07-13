<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/

//Restrict direct access
defined('_JEXEC') or die('Restricted access');

require JPATH_SITE . '/modules/mod_ruxin_news/tmpl/blocks/blocks.php';

require_once JPATH_SITE . '/modules/mod_ruxin_news/helper.php';
require_once JPATH_SITE . '/modules/mod_ruxin_news/classes/functions.php';


//Get list content
$list = modRuxinNewsHelper::getList($params);

require(JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default')));

?>