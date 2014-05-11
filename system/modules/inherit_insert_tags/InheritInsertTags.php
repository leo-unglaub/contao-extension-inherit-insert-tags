<?php

/**
 * contao-inherit-insert-tags
 *
 * @copyright	Leo Unglaub 2014
 * @author		Leo Unglaub <leo@leo-unglaub.net>
 * @package		contao-inherit-insert-tags
 * @license		GPL
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
