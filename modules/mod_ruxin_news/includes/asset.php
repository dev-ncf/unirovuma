<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/

//Restrict direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField
{

    protected $type = 'Asset';

    protected function getInput()
    {
        JHTML::_('behavior.framework');
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . $this->element['path'] . 'js/fields.js');
		$document->addStyleSheet(JURI::root() . $this->element['path'] . 'css/ruxin_backend.css');
        return null;
    }
}

?>
