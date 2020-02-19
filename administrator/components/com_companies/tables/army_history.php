<?php
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class TableCompaniesArmy_history extends Table
{
    var $id = null;
    var $companyID = null;
    var $army_year = null;
    var $square_type = null;
    var $square_value = null;
    var $targets = null;
    var $thematics = null;
    var $stand = null;
    var $exposition = null;
    var $diversification = null;
    var $forum_new_items = null;
    var $full_new_items = null;
    var $is_ndp = null;
    var $comment = null;
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__mkv_companies_army_history', 'id', $db);
	}

	public function store($updateNulls = true)
    {
        return parent::store($updateNulls);
    }
}