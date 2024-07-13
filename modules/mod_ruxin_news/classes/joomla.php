<?php
/**--------------------------------------
 * @package     ruxin_news - Ruxin News
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * ---------------------------------------**/
//Restrict direct access
defined('_JEXEC') or die('Restricted access');

/**
 * RuxinK2ContentSource Class
 */

require_once JPATH_SITE . '/components/com_content/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

require_once 'ruxinsource.php';
if (!class_exists('RuxinJoomlaContentSource')) {
    class RuxinJoomlaContentSource extends RuxinSource
    {

        /**--------------------------------------
         * Retrieve a list of article
         * @param   \Joomla\Registry\Registry &$params module parameters
         * @return  mixed
         * ---------------------------------------**/
        public function getList()
        {
            $params = &$this->_params;

            // Get the dbo
            $db = JFactory::getDbo();

            // Get an instance of the generic articles model
            $model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

            // Set application parameters in model
            $app = JFactory::getApplication();
            $appParams = $app->getParams();
            $model->setState('params', $appParams);

            // Set the filters based on the module params
			
			
			$lead_count = $params->get('lead_count', 0);
			$intro_count = $params->get('intro_count', 0);
			$link_count = $params->get('link_count', 0);
			$count = $lead_count + $intro_count + $link_count;
			
			
            $list_start = isset($_GET['page']) ? ($_GET['page']*$count)+$params->get('start_from', 0) : $params->get('start_from', 0);
            $model->setState('list.start', $list_start);
            $model->setState('list.limit', (int)$count);
            $model->setState('filter.published', 1);

            // Access filter
            $access = !JComponentHelper::getParams('com_content')->get('show_noauth');
            $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
            $model->setState('filter.access', $access);

            // Category filter
            $model->setState('filter.category_id', $params->get('catid', array()));

            // User filter
            $userId = JFactory::getUser()->get('id');

            switch ($params->get('user_id')) {
                case 'by_me' :
                    $model->setState('filter.author_id', (int)$userId);
                    break;
                case 'not_me' :
                    $model->setState('filter.author_id', $userId);
                    $model->setState('filter.author_id.include', false);
                    break;

                case '0' :
                    break;

                default:
                    $model->setState('filter.author_id', (int)$params->get('user_id'));
                    break;
            }

            // Filter by language
            $model->setState('filter.language', $app->getLanguageFilter());

            // Set Day Filter

            if ($params->get('day_filter')) {
                $model->setState('filter.date_filtering', 'relative');
                $model->setState('filter.relative_date', $params->get('day_filter'));
            }

            //  Featured switch
            switch ($params->get('show_featured')) {
                case '1' :
                    $model->setState('filter.featured', 'only');
                    break;
                case '0' :
                    $model->setState('filter.featured', 'hide');
                    break;
                default :
                    $model->setState('filter.featured', 'show');
                    break;
            }

            // Set ordering

            $ordering = $params->get('ordering', 'created-desc');
            $ordering = explode('-', $ordering);

            if (trim($ordering[0]) == 'rand') {
                $model->setState('list.ordering', ' RAND() ');
            } else
                if (trim($ordering[0]) == 'featured') {
					
                    $model->setState('list.ordering', 'fp.ordering');
					if (trim($ordering[1]) == 'asc') {
						$model->setState('list.direction', 'asc');
					} else {
						$model->setState('list.direction', 'desc');
					}
                    
                } else {
                    $model->setState('list.ordering', 'a.' . $ordering[0]);
                    $model->setState('list.direction', $ordering[1]);
                }
            $items = $model->getItems();

            foreach ($items as &$item) {
                $item->slug = $item->id . ':' . $item->alias;
                $item->catslug = $item->catid . ':' . $item->category_alias;

                $item->categoryLink = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug));

                if ($access || in_array($item->access, $authorised)) {
                    // We know that user has the privilege to view the article
                    $item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
                } else {
                    $item->link = JRoute::_('index.php?option=com_users&view=login');
                }
            }

            return $items;
        }
    }
}