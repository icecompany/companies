<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewCompany extends HtmlView {
    protected $item, $form, $script, $links, $contracts, $clients, $cooperations, $foivs, $partners;

    public function display($tmp = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        $this->links = $this->get('Links');
        if ($this->item->id !== null) {
            $this->contracts = $this->get('Contracts');
            $this->clients = $this->get('Clients');
            $this->cooperations = $this->get('Cooperations');
            $this->foivs = $this->get('Foivs');
            $this->partners = $this->get('Partners');
        }

        $this->addToolbar();
        $this->setDocument();

        parent::display($tmp);
    }

    protected function addToolbar() {
        JToolBarHelper::apply('company.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('company.save', 'JTOOLBAR_SAVE');
        if ($this->item->id !== null) {
            JToolbarHelper::custom('company.add_contract', 'briefcase', 'briefcase', JText::sprintf('COM_COMPANIES_BUTTON_ADD_CONTRACT'), false);
        }
        JToolbarHelper::cancel('company.cancel', 'JTOOLBAR_CLOSE');
        JFactory::getApplication()->input->set('hidemainmenu', true);
    }

    protected function setDocument() {
        $title = ($this->item->id !== null) ? JText::sprintf('COM_COMPANIES_TITLE_EDIT_COMPANY', $this->item->title) : JText::sprintf('COM_COMPANIES_TITLE_ADD_COMPANY');
        JToolbarHelper::title($title, 'home');
        JHtml::_('bootstrap.framework');
    }
}