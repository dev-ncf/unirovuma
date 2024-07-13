<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/
//Restrict direct access
defined('_JEXEC') or die('Restricted access');

/**--------------------------------------
 * class RuxinSource
 * ---------------------------------------**/
if (!class_exists('RuxinSource')) {
    abstract class RuxinSource
    {

        public function __construct($params = null)
        {
            $this->_params = $params;
        }

        /**--------------------------------------
         * Get list article (abstract function)
         * ---------------------------------------**/
        abstract public function getList();

    }

}
