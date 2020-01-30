<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewActivity extends HtmlView {
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
	    JToolBarHelper::apply('activity.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('activity.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('activity.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = ($this->item->id !== null) ? JText::sprintf('COM_COMPANIES_TITLE_EDIT_ACTIVITY', $this->item->title) : JText::sprintf('COM_COMPANIES_TITLE_ADD_ACTIVITY');
        JToolbarHelper::title($title, 'signup');
        JHtml::_('bootstrap.framework');
    }
}