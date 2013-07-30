<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Unglaub 2012
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    inherit_insert_tags
 * @license    lgpl
 */


/**
 * Class InheritInsertTags
 * Provide methods to parse insert tags
 */
class InheritInsertTags extends Controller
{
	/**
	 * Replace all defined insert tags
	 *
	 * @param string $strInsertTag
	 * @return mixed
	 */
	public function doReplaceInsertTags($strInsertTag)
	{
		$arrChunks = explode('::', $strInsertTag);

		// check if it's a interit insert tag, otherwize return false
		if ($arrChunks[0] == 'iit' && $arrChunks['1'] != '')
		{
			global $objPage;

			$arrInsertTags = array();
			$arrGlobalInserTags = (array) deserialize($GLOBALS['TL_CONFIG']['inherit_insert_tags']);
			$arrRootInsertTags = $this->getRootInsertTags();
			$arrSiteInsertTags = (array) deserialize($objPage->inherit_insert_tags);

			// merge all global insert tags
			foreach ($arrGlobalInserTags as $v)
			{
				$arrInsertTags[$v['iit_name']] = $v['iit_value'];
			}

			// merge all insert tags from the root page
			foreach ($arrRootInsertTags as $v)
			{
				$arrInsertTags[$v['iit_name']] = $v['iit_value'];
			}

			// merge all insert tags from the current page
			foreach ($arrSiteInsertTags as $v)
			{
				$arrInsertTags[$v['iit_name']] = $v['iit_value'];
			}


			// check if the key exists and return the value
			if (array_key_exists($arrChunks[1], $arrInsertTags))
			{
				return $arrInsertTags[$arrChunks[1]];
			}
		}

		return false;
	}


	/**
	 * Get all insert tags from the root page
	 *
	 * @param void
	 * @return array
	 */
	protected function getRootInsertTags()
	{
		$this->import('Database');

		global $objPage;
		$arrReturn = array();

		// get all insert tags from the root page
		$objRootInsertTags = $this->Database->prepare('SELECT inherit_insert_tags as iit FROM tl_page WHERE id=?')
											->limit(1)
											->execute($objPage->rootId);

		// normaly we have a root page, but in case the contao install is broken we check it
		if ($objRootInsertTags->numRows == 1)
		{
			$arrReturn = (array) deserialize($objRootInsertTags->iit);
		}

		return $arrReturn;
	}
}


?>