<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesClients extends Table
{
    var $id = null;
    var $companyID = null;
    var $clientID = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_clients', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}