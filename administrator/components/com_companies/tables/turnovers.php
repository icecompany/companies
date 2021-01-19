<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesTurnovers extends Table
{
    var $id = null;
    var $companyID = null;
    var $year = null;
    var $turnover = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_turnover', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}