<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewOtherProject extends HtmlView {
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
	    JToolBarHelper::apply('otherproject.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('otherproject.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('otherproject.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = JText::sprintf('COM_COMPANIES_TITLE_EDIT_OTHER_PROJECT', $this->item->company);
        JToolbarHelper::title($title, 'address');
        JHtml::_('bootstrap.framework');
    }
}