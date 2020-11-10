<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesFoivs extends Table
{
    var $id = null;
    var $title = null;
    var $title_full = null;

	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_foivs', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}