<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewContact extends HtmlView {
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
        if ($this->item->canSave) {
            JToolBarHelper::apply('contact.apply', 'JTOOLBAR_APPLY');
            JToolbarHelper::save('contact.save', 'JTOOLBAR_SAVE');
        }
        JToolbarHelper::cancel('contact.cancel', 'JTOOLBAR_CLOSE');
        JFactory::getApplication()->input->set('hidemainmenu', true);
    }

    protected function setDocument() {
        if ($this->item->id !== null) {
            $title = JText::sprintf('COM_COMPANIES_TITLE_EDIT_CONTACT', $this->item->fio);
        }
        else {
            $title = JText::sprintf('COM_COMPANIES_TITLE_ADD_CONTACT', $this->item->company);
        }
        JToolbarHelper::title($title, 'vcard');
        JHtml::_('bootstrap.framework');
    }
}