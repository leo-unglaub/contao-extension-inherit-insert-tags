<?php

/**
 * contao-inherit-insert-tags
 *
 * @copyright	Leo Unglaub 2014
 * @author		Leo Unglaub <leo@leo-unglaub.net>
 * @package		contao-inherit-insert-tags
 * @license		GPL
 */


// use the language string from the tl_page file
$this->loadLanguageFile('tl_page');


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace
(
	'gzipScripts',
	'gzipScripts,inherit_insert_tags',
	$GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['inherit_insert_tags'] = array
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
