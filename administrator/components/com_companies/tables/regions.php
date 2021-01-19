<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesRegions extends Table
{
    var $id = null;
    var $companyID = null;
    var $regionID = null;
    var $struct = null;
    var $comment = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_regions', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}