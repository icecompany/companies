<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewParent extends HtmlView {
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
        JToolbarHelper::save('parent.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('parent.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = JText::sprintf('COM_COMPANIES_TITLE_ADD_CHILDREN', $this->item->company);
        JToolbarHelper::title($title, 'vcard');
        JHtml::_('bootstrap.framework');
    }
}