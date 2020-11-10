<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewCompaniesFoiv extends HtmlView {
    protected $item, $form, $script;

    public function display($tmp = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');

        $this->addToolbar();
        $this->setDocument();

        parent::display($tmp);
    }

    protected function addToolbar() {
	    JToolBarHelper::apply('companiesfoiv.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('companiesfoiv.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('companiesfoiv.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = JText::sprintf('COM_COMPANIES_TITLE_EDIT_COMPANIES_FOIV', $this->item->company);
        JToolbarHelper::title($title, 'home');
        JHtml::_('bootstrap.framework');
    }
}