<?php
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class CompaniesViewCompanies extends HtmlView
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
        $this->filterForm->addFieldPath(JPATH_ADMINISTRATOR . "/components/com_prj/models/fields");

        // Show the toolbar
        $this->toolbar();
        $this->setFilters();

        // Show the sidebar
        CompaniesHelper::addSubmenu('companies');
        $this->sidebar = JHtmlSidebar::render();

        // Display it all
        return parent::display($tpl);
    }

    private function setFilters()
    {
        if (!CompaniesHelper::canDo('core.edit.state')) {
            $this->filterForm->removeField('state', 'filter');
        }
    }

    private function toolbar()
    {
        JToolBarHelper::title(JText::sprintf('COM_COMPANIES_MENU_COMPANIES'), 'home');

        if (CompaniesHelper::canDo('core.create'))
        {
            JToolbarHelper::addNew('company.add');
        }
        if (CompaniesHelper::canDo('core.edit'))
        {
            JToolbarHelper::editList('company.edit');
        }
        if (CompaniesHelper::canDo('core.edit.state') && $this->state->get('filter.state') !== '-2')
        {
            JToolbarHelper::trash('companies.trash');
        }
        if (CompaniesHelper::canDo('core.edit.state') && $this->state->get('filter.state') === '-2')
        {
            JToolbarHelper::publish('companies.publish', JText::sprintf('COM_COMPANIES_LINK_COMPANY_PUBLISH'));
        }
        if (CompaniesHelper::canDo('core.access.dossier'))
        {
            JToolbarHelper::custom('companies.sync', 'loop', 'refresh', JText::sprintf('COM_COMPANIES_LINK_SYNC_OLD_AND_NEW_DATA'), false);
        }
        if (CompaniesHelper::canDo('core.delete'))
        {
            JToolbarHelper::deleteList('COM_COMPANIES_CONFIRM_REMOVE_COMPANY', 'companies.delete');
        }
        if (CompaniesHelper::canDo('core.admin'))
        {
            JToolBarHelper::preferences('com_companies');
        }
    }
}
