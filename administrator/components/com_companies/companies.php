<?php
/**
 * @package    companies
 *
 * @author     Admin <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

// Access check.
if (!Factory::getUser()->authorise('core.manage', 'com_companies'))
{
	throw new InvalidArgumentException(Text::_('JERROR_ALERTNOAUTHOR'), 404);
}

// Require the helper
JFactory::getLanguage()->load('com_mkv', JPATH_ADMINISTRATOR . "/components/com_mkv", 'ru-RU', true);
JFactory::getLanguage()->load('com_prj', JPATH_ADMINISTRATOR . "/components/com_prj", 'ru-RU', true);
require_once JPATH_ADMINISTRATOR . "/components/com_mkv/helpers/mkv.php";
require_once JPATH_ADMINISTRATOR . "/components/com_prj/helpers/prj.php";
require_once JPATH_ADMINISTRATOR . "/components/com_contracts/helpers/contracts.php";
require_once JPATH_ADMINISTRATOR . "/components/com_finances/helpers/finances.php";
require_once JPATH_ADMINISTRATOR . "/components/com_scheduler/helpers/scheduler.php";
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/companies.php';
require_once JPATH_COMPONENT_ADMINISTRATOR . '/passwd.php';
$db = JFactory::getDbo();
$passwd = $db->q($credentials->password);
$db->setQuery("SELECT @pass:={$passwd}")->execute();

// Execute the task
$controller = BaseController::getInstance('companies');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
