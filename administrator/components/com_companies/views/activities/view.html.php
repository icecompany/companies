<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class CompaniesViewActivities extends HtmlView
{
    protected $sidebar = '';
    public $items, $pagination, $uid, $state, $filterForm, $activeFilters;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Show the toolbar
        $this->toolbar();

        // Show the sidebar
        CompaniesHelper::addSubmenu('activities');
        $this->sidebar = JHtmlSidebar::render();

        // Display it all
        return parent::display($tpl);
    }

    private function toolbar()
    {
        JToolBarHelper::title(JText::sprintf('COM_COMPANIES_MENU_ACTIVITIES'), 'signup');

        if (CompaniesHelper::canDo('core.create'))
        {
            JToolbarHelper::addNew('activity.add');
        }
        if (CompaniesHelper::canDo('core.edit'))
        {
            JToolbarHelper::editList('activity.edit');
        }
        if (CompaniesHelper::canDo('core.delete'))
        {
            JToolbarHelper::deleteList('COM_COMPANIES_CONFIRM_REMOVE_ACTIVITY', 'activities.delete');
        }
        if (CompaniesHelper::canDo('core.admin'))
        {
            JToolBarHelper::preferences('com_companies');
        }
    }
}
