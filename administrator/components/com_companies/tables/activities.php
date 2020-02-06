<?php
/**
 * @package    companies
 *
 * @author     Admin <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

/**
 * Companies table.
 *
 * @package   companies
 * @since     1.0.0
 */
class TableCompaniesActivities extends Table
{
    var $id = null;
    var $title = null;
    var $for_contractor = null;
    var $for_ndp = null;
    var $weight = null;
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0.0
	 */
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_activities', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}