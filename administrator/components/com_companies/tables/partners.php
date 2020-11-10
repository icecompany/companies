<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesPartners extends Table
{
    var $id = null;
    var $company_1_ID = null;
    var $company_2_ID = null;
    var $type = null;
    var $comment = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_partners', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}