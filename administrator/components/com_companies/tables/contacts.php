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
class TableCompaniesContacts extends Table
{
    var $id = null;
    var $companyID = null;
    var $fio = null;
    var $post = null;
    var $phone_work = null;
    var $phone_mobile = null;
    var $email = null;
    var $for_accreditation = null;
    var $for_building = null;
    var $comment = null;
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0.0
	 */
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_contacts', 'id', $db);
	}

	public function load($keys = null, $reset = true)
    {
        if (empty($keys)) return true;
        if ($reset) $this->reset();

        $keys = array($this->getKeyName() => $keys);

        $query = $this->_db->getQuery(true)
            ->select('id, companyID, fio, post, for_accreditation, for_building, comment')
            ->select("IF(phone_work is not null, AES_DECRYPT(phone_work, @pass), null) as phone_work")
            ->select("IF(phone_mobile is not null, AES_DECRYPT(phone_mobile, @pass), null) as phone_mobile")
            ->select("IF(email is not null, AES_DECRYPT(email, @pass), null) as email")
            ->from("#__mkv_companies_contacts");

        $fields = array_keys($this->getProperties());
        foreach ($keys as $field => $value) {
            if (!in_array($field, $fields)) {
                throw new \UnexpectedValueException(sprintf('Missing field in database: %s &#160; %s.', get_class($this), $field));
            }
            $query->where($this->_db->qn($field) . ' = ' . $this->_db->q($value));
        }

        $this->_db->setQuery($query);
        $row = $this->_db->loadAssoc();

        return (!empty($row)) ? $this->bind($row) : false;
    }

    public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}