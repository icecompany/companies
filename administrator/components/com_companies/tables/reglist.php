<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesReglist extends Table
{
    var $id = null;
    var $code = null;
    var $title = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__russian_regions', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}