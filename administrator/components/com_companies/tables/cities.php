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
class TableCompaniesCities extends Table
{
    var $id = null;
    var $city = null;
    var $region_id = null;
    var $region = null;
    var $country_id = null;
    var $country = null;
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0.0
	 */
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__grph_cities_all', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}