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
	
// check k2 existing
if (is_file(JPATH_SITE . "/components/com_k2/k2.php")) {
	require_once JPATH_SITE . '/components/com_k2/helpers/route.php';
	require_once(JPath::clean(JPATH_SITE . '/components/com_k2/helpers/utilities.php'));
}
require_once 'ruxinsource.php';

if (!class_exists('RuxinK2ContentSource')) {
    class RuxinK2ContentSource extends RuxinSource
    {

        /**--------------------------------------
         * get the list of k2 items
         * @param JParameter $params ;
         * @return Array
         * ---------------------------------------**/
        public function getList()
        {

            // check k2 existing
            if (!is_file(JPATH_SITE . "/components/com_k2/k2.php")) {
                return array();
            }
            $params = &$this->_params;
			
			
			$lead_count = $params->get('lead_count', 0);
			$intro_count = $params->get('intro_count', 0);
			$link_count = $params->get('link_count', 0);
			$count = $lead_count + $intro_count + $link_count;
			
			
            $ordering = $params->get('ordering', 'created-desc');
            $limit = $count;
            $list_start = isset($_GET['page']) ? ($_GET['page']*$count)+$params->get('start_from', 0) : $params->get('start_from', 0);

            // Set ordering
            $ordering = explode('-', $ordering);
            if (trim($ordering[0]) == 'rand') {
                $ordering = ' RAND() ';
            } else {
                $ordering = $ordering[0] . ' ' . $ordering[1];
            }

            $user = JFactory::getUser();
            $db = JFactory::getDBO();
            $date = JFactory::getDate();
            $now = $date->toSQL();
            $dateFormat = $params->get('date_format', 'NO');

            // main query
            $query = "SELECT  a.*, c.name as category_title,
						c.id as categoryid, c.alias as categoryalias, c.params as categoryparams" . " FROM #__k2_items as a" . " LEFT JOIN #__k2_categories c ON c.id = a.catid";

            $query .= " WHERE a.published = 1" . " AND a.access IN(" . implode(',', $user->getAuthorisedViewLevels()) . ")" . " AND a.trash = 0" . " AND c.published = 1" . " AND c.access IN(" . implode(',', $user->getAuthorisedViewLevels()) . ")" . " AND c.trash = 0 ";
			
            // filter by user
            $userId = $user->get('id');
            switch ($params->get('user_id')) {
                case 'by_me':
                    $query .= 'AND a.created_by = ' . $userId;
                    break;
                case 'not_me':
                    $query .= 'AND a.created_by != ' . $userId;
                    break;
                case 0:
                    break;
                default:
                    $query .= 'AND a.created_by = ' . $userId;
                    break;
            }

            // filter by featured params
            if ($params->get('show_featured',"1") == 0) {
                $query .= " AND a.featured != 1";
            } elseif ($params->get('show_featured') == 1) {
                $query .= " AND a.featured = 1";
            }

            // valid publish date
            $jnow = JFactory::getDate();
            $now = $jnow->toSql();
            $nullDate = $db->getNullDate();
            $query .= " AND ( a.publish_up = " . $db->Quote($nullDate) . " OR a.publish_up <= " . $db->Quote($now) . " )";
            $query .= " AND ( a.publish_down = " . $db->Quote($nullDate) . " OR a.publish_down >= " . $db->Quote($now) . " )";

			// filter by day
			if ($params->get('day_filter')) {
				$query .= " AND a.publish_up <= " . $db->Quote($now) . " AND a.publish_up >= DATE(" . $db->Quote($now) . " - INTERVAL " . $db->Quote($params->get('day_filter')) . " DAY)";

			}
			
            //filter by language
            $languageTag = JFactory::getLanguage()->getTag();
            $query .= " AND a.language IN (" . $db->quote($languageTag) . "," . $db->quote('*') . ") AND c.language IN (" . $db->quote($languageTag) . "," . $db->quote('*') . ")";

            //Get data
            $data = array();
            $source = trim($this->_params->get('source', 'k2_category'));
            $catids = self::getCategoryIds();
            if ($source == 'k2_category' && !empty($catids) && $this->_params->get('limit_items_for_each')) {
                $db->setQuery('SELECT id from #__k2_categories where id in (' . implode($catids, ',') . ') order by ordering');
                $catids = $db->loadColumn();
                foreach ($catids as $catid) {
                    $condition = ' AND  a.catid = ' . $catid . ' ';
                    $db->setQuery($query . $condition . ' ORDER BY ' . $ordering . ($limit ? ' LIMIT ' . $list_start . ',' .$limit : ''));
                    $data = array_merge($data, $db->loadObjectlist());
                }
            } else {
                $condition = $this->buildConditionQuery($source, $catids);
                $db->setQuery($query . $condition . ' ORDER BY ' . $ordering . ($limit ? ' LIMIT ' . $list_start . ',' .$limit : ''));
                $data = array_merge($data, $db->loadObjectlist());
            }

            // Rebuild data
            foreach ($data as $key => &$item) {

                // authorise
                if (in_array($item->access, $user->getAuthorisedViewLevels())) {
                    $item->link = JRoute::_(K2HelperRoute::getItemRoute($item->id . ':' . $item->alias, $item->catid . ':' . $item->categoryalias));
                } else {
                    $item->link = JRoute::_('index.php?option=com_users&view=login');
                }

                // format date
                $item->date = JHtml::_('date', $item->created, JText::_($dateFormat));


                // escape html characters
                $item->title = htmlspecialchars($item->title);

                // import joomla content prepare plugin
                if ($params->get('content_plugin')) {
                    $item->introtext = JHtml::_('content.prepare', $item->introtext);
                }


                $item->categoryLink = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($item->catid . ':' . urlencode($item->categoryalias))));

            }

            return $data;
        }

        /* build condition for query */
        public function buildConditionQuery($source, $catids = '')
        {

            if ($source == 'k2_category') {
                if (empty($catids)) {
                    $condition = '';
                } else {
                    $condition = ' AND  a.catid IN("' . implode('","', $catids) . '")';
                }
            }
            return $condition;
        }

        /*get category id for query function */
        function getCategoryIds()
        {
            $catids = array();
            if ($this->_params->get('auto_category') && JRequest::getVar('option') == 'com_k2') {
                if (JRequest::getVar('view') == 'itemlist') {
                    $catid = JRequest::getInt('id');
                    if ($catid) $catids = array($catid);
                } else {
                    if (JRequest::getVar('view') == 'item') {
                        $db = JFactory::getDBO();
                        $itemid = JRequest::getInt('id');
                        $query = 'SELECT catid from #__k2_items where id=' . $itemid;
                        $db->setQuery($query);
                        $catid = $db->loadResult();
                        if ($catid) $catids = array($catid);
                    }
                }
            }
            if (empty($catids)) {
                $catids = $this->_params->get('k2_category', array());
            }

            //since 2.4.2
            if ($this->_params->get('sub_categories', 0) && count($catids)) {
                $db = JFactory::getDBO();
                $parents = $catids;
                foreach ($parents as $c) {
                    $db->setQuery('SELECT id FROM #__k2_categories WHERE parent = ' . $c);
                    $children = $db->loadColumn();
                    if ($children && count($children)) {
                        $catids = array_merge($catids, $children);
                    }
                }
                $catids = array_unique($catids);
            }
            $excluded = str_replace(' ', '', $this->_params->get('exclude_categories', ''));
            if ($excluded) {
                $excluded = explode(',', $excluded);

                if ($excluded && count($excluded)) {
                    $catids = array_diff($catids, $excluded);
                }
            }

            return $catids;
        }

    }
}
