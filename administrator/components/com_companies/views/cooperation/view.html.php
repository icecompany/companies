<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewCooperation extends HtmlView {
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
	    JToolBarHelper::apply('cooperation.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('cooperation.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('cooperation.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = JText::sprintf('COM_COMPANIES_TITLE_EDIT_COOPERATION', $this->item->company);
        JToolbarHelper::title($title, 'search');
        JHtml::_('bootstrap.framework');
    }
}