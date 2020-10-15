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

class TableCompaniesComplain extends Table
{
    var $id = null;
    var $old_title = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_complain', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}