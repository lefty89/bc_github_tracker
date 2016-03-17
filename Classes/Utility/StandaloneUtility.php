<?php

namespace BC\BcGithubTracker\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (C) 2016 Lefty (fb.lefty@web.de)
 *
 *  This script is part of the Typo3 project. The Typo3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this script. If not, see <http://www.gnu.org/licenses/>.
 *
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * @author Lefty (fb.lefty@web.de)
 * @package TYPO3
 * @subpackage bc_github_tracker
 */
class StandaloneUtility {

	/**
	 * render template
	 *
	 * @param string $templateFile
	 * @param array $variables
	 * @return string
	 */
	public static function renderStandaloneView($templateFile, $variables = array()) {

		/** @var array $frameworkConf */
		$frameworkConf = TyposcriptUtility::getConfiguration();

		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);

		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $standaloneView */
		$standaloneView = $objectManager->get(StandaloneView::class);

		/** @var string $layoutPath */
		$layoutPath = GeneralUtility::getFileAbsFileName($frameworkConf['view']['layoutRootPath']);

		/** @var string $templatePathAndFilename */
		$templatePathAndFilename = GeneralUtility::getFileAbsFileName($templateFile);

		$standaloneView->setTemplatePathAndFilename($templatePathAndFilename);
		$standaloneView->setLayoutRootPaths(array($layoutPath));
		$standaloneView->assignMultiple($variables);

		return $standaloneView->render();
	}
}