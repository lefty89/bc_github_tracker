<?php

namespace BC\BcGithubTracker\Controller;

/**
 *
 * User: Lefty
 * Date: 31.01.2015
 * Time: 13:21
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


/**
 * Class RenderController
 * @package BC\BcCodeHighlighter\Controller
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