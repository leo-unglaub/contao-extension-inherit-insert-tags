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
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('InheritInsertTags', 'doReplaceInsertTags');
