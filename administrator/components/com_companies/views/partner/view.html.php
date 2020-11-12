<?php
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView;

class CompaniesViewPartner extends HtmlView {
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
        JToolbarHelper::save('partner.save', 'JTOOLBAR_SAVE');
        JToolbarHelper::cancel('partner.cancel', 'JTOOLBAR_CLOSE');
    }

    protected function setDocument() {
        $title = JText::sprintf('COM_COMPANIES_TITLE_EDIT_PARTNER', $this->item->company);
        JToolbarHelper::title($title, 'home');
        JHtml::_('bootstrap.framework');
    }
}