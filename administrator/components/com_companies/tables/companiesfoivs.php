<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesCompaniesFoivs extends Table
{
    var $id = null;
    var $companyID = null;
    var $foivID = null;
    var $department = null;
    var $comment = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_foivs', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}