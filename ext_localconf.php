<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'BC.' . $_EXTKEY,
	'Tracker',
	array(
		'Tracker' => 'render',
	),
	// non-cacheable actions
	array(
		'Tracker' => 'render',
	)
);