<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesOther_projects extends Table
{
    var $id = null;
    var $companyID = null;
    var $year = null;
    var $title = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_projects_other', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}