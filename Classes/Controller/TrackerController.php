<?php

namespace BC\BcGithubTracker\Controller;

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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * @author Lefty (fb.lefty@web.de)
 * @package TYPO3
 * @subpackage bc_github_tracker
 */
class TrackerController extends ActionController {

	/**
	 * render
	 */
	public function renderAction() {

		// add css and js
		$this->addResources();

		/** @var string $flexValue */
		$flexValue = $this->settings['custom'];

		/** @var Object $data */
		$data = json_decode(urldecode((base64_decode($flexValue))));

		$this->view->assign('data', $data);
	}

	/**
	 * adds required resources (js/css)
	 */
	private function addResources()
	{
		/** @var string $extPath */
		$extPath = ExtensionManagementUtility::siteRelPath("bc_github_tracker").'Resources/Public/';

		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pr */
		$pr = $GLOBALS['TSFE']->getPageRenderer();

		// add css files
		$pr->addCssFile($extPath.'css/style.css');

		// add js files
		$pr->addJsFooterFile($extPath.'js/moment.js');
		$pr->addJsFooterFile($extPath.'js/main.js');
	}
}