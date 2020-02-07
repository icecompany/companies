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
class TableCompaniesCompanies extends Table
{
    var $id = null;
    var $is_contractor = null;
    var $is_ndp = null;
    var $form = null;
    var $title = null;
    var $title_full = null;
    var $title_en = null;
    var $director_name = null;
    var $director_post = null;
    var $legal_city = null;
    var $legal_index = null;
    var $legal_street = null;
    var $legal_house = null;
    var $fact_city = null;
    var $fact_index = null;
    var $fact_street = null;
    var $fact_house = null;
    var $phone_1 = null;
    var $phone_1_additional = null;
    var $phone_1_comment = null;
    var $phone_2 = null;
    var $phone_2_additional = null;
    var $phone_2_comment = null;
    var $fax = null;
    var $fax_additional = null;
    var $email = null;
    var $site = null;
    var $inn = null;
    var $kpp = null;
    var $rs = null;
    var $ks = null;
    var $bank = null;
    var $bik = null;
    var $comment = null;
    var $published = null;
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0.0
	 */
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}