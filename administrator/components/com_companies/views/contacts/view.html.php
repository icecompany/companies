<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class CompaniesViewContacts extends HtmlView
{
    protected $sidebar = '';
    public $items, $pagination, $state, $filterForm, $activeFilters;

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
        CompaniesHelper::addSubmenu('contacts');
        $this->sidebar = JHtmlSidebar::render();

        // Display it all
        return parent::display($tpl);
    }

    private function toolbar()
    {
        JToolBarHelper::title(JText::sprintf('COM_COMPANIES_MENU_CONTACTS'), 'users');

        if (CompaniesHelper::canDo('core.delete'))
        {
            JToolbarHelper::deleteList('COM_COMPANIES_CONFIRM_REMOVE_CONTACT', 'contacts.delete');
        }
        if (CompaniesHelper::canDo('core.admin'))
        {
            JToolBarHelper::preferences('com_companies');
        }
    }
}
