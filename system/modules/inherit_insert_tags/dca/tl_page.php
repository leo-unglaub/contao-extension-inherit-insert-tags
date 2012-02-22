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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace('datimFormat', 'datimFormat,inherit_insert_tags', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace('description', 'description,inherit_insert_tags', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['inherit_insert_tags'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['inherit_insert_tags'],
	'exclude'		=> true,
	'inputType'		=> 'multiColumnWizard',
	'eval' 			=> array
	(
		'columnFields' => array
		(
			'iit_name' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_page']['iit_name'],
				'exclude'		=> true,
				'inputType'		=> 'text',
				'eval'			=> array('style'=>'width:200px', 'rgxp'=>'alnum')
			),
			'iit_value' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_page']['iit_value'],
				'exclude'		=> true,
				'inputType'		=> 'text',
				'eval'			=> array('style'=>'width:380px')
			)
		),
		'tl_class'=>'clr'
	)
);

?>