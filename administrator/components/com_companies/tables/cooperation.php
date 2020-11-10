<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesCooperation extends Table
{
    var $id = null;
    var $companyID = null;
    var $clientID = null;
    var $comment = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_cooperation', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}