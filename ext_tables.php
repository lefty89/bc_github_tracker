<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Bugcluster Github Tracker');

// underscored extension name
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));

/**
 * Flexform for Tracker Plugin
 */
$TCA['tt_content']['types']['list']['subtypes_addlist'][$extensionName.'_tracker'] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($extensionName.'_tracker', 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForm/flexform_tracker.xml');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Tracker',
	'Bugcluster Github Tracker'
);