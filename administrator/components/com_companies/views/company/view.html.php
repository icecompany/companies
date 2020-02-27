<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewCompany extends HtmlView {
    protected $item, $form, $script, $links;

    public function display($tmp = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        $this->links = $this->get('Links');

        $this->addToolbar();
        $this->setDocument();

        parent::display($tmp);
    }

    protected function addToolbar() {
        JToolBarHelper::apply('company.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('company.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('company.cancel', 'JTOOLBAR_CLOSE');
        JFactory::getApplication()->input->set('hidemainmenu', true);
    }

    protected function setDocument() {
        $title = ($this->item->id !== null) ? JText::sprintf('COM_COMPANIES_TITLE_EDIT_COMPANY', $this->item->title) : JText::sprintf('COM_COMPANIES_TITLE_ADD_COMPANY');
        JToolbarHelper::title($title, 'home');
        JHtml::_('bootstrap.framework');
    }
}