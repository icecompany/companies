<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelContacts extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'c.id',
                'companyID',
                'c.fio',
                'company',
                'c.for_building', 'for_building',
                'c.for_accreditation', 'for_accreditation',
            );
        }
        $this->export = false;
        $this->companyID = (!isset($config['companyID'])) ? 0 : $config['companyID'];
        parent::__construct($config);
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("c.id, c.companyID, c.fio, c.post, c.for_accreditation, c.for_building, c.comment")
            ->select("c.phone_work_additional, phone_mobile_additional")
            ->select("aes_decrypt(c.phone_work,@pass) as phone_work")
            ->select("aes_decrypt(c.phone_mobile,@pass) as phone_mobile")
            ->select("aes_decrypt(c.email,@pass) as email")
            ->from("#__mkv_companies_contacts c");
        if ($this->companyID > 0) {
            $query->where("c.companyID = {$this->companyID}");
            $this->setState('list.limit', 0);
        }
        else {
            $query
                ->select("e.title as company")
                ->leftJoin("#__mkv_companies e on e.id = c.companyID");

            /* Поиск */
            $search = $this->getState('filter.search');
            if (!empty($search)) {
                $search = $this->_db->q("%{$search}%");
                $query->where("(c.fio LIKE {$search} OR e.title LIKE {$search})");
            }

            /* Фильтры */
            $for_accreditation = $this->getState('filter.for_accreditation');
            if (is_numeric($for_accreditation)) {
                $for_accreditation = $this->_db->q($for_accreditation);
                $query->where("c.for_accreditation = {$for_accreditation}");
            }
            $for_building = $this->getState('filter.for_building');
            if (is_numeric($for_building)) {
                $for_building = $this->_db->q($for_building);
                $query->where("c.for_building = {$for_building}");
            }

            /* Сортировка */
            $orderCol = $this->state->get('list.ordering');
            $orderDirn = $this->state->get('list.direction');
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array();
        $return = CompaniesHelper::getReturnUrl();
        $token = JSession::getFormToken();
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['companyID'] = $item->companyID;
            $arr['fio'] = $item->fio;
            $arr['post'] = $item->post;
            $arr['company'] = $item->company;
            $url = JRoute::_("index.php?option={$this->option}&amp;task=company.edit&amp;id={$item->companyID}&amp;return={$return}");
            $arr['company_link'] = JHtml::link($url, $item->company);
            $arr['phone_work'] = $item->phone_work;
            $url = JRoute::_("tel:{$item->phone_work}");
            $arr['phone_work_link'] = JHtml::link($url, ($item->phone_work_additional !== null) ? JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_PHONE_ADDITIONAL_SHORT', $item->phone_work, $item->phone_work_additional) : $item->phone_work);
            $arr['phone_mobile'] = $item->phone_mobile;
            $url = JRoute::_("tel:{$item->phone_mobile}");
            $arr['phone_mobile_link'] = JHtml::link($url, ($item->phone_mobile_additional !== null) ? JText::sprintf('COM_COMPANIES_HEAD_CONTACTS_PHONE_ADDITIONAL_SHORT', $item->phone_mobile, $item->phone_mobile_additional) : $item->phone_mobile);
            $arr['email'] = $item->email;
            $url = JRoute::_("mailto:{$item->email}");
            $arr['email_link'] = JHtml::link($url, $item->email);
            $arr['for_accreditation'] = JText::sprintf(($item->for_accreditation) ? 'JYES' : 'JNO');
            $arr['for_building'] = JText::sprintf(($item->for_building) ? 'JYES' : 'JNO');
            $arr['comment'] = $item->comment;
            $url = JRoute::_("index.php?option={$this->option}&amp;task=contact.edit&amp;id={$item->id}&amp;return={$return}");
            $arr['edit_link'] = JHtml::link($url, $item->fio);
            $url = JRoute::_("index.php?option={$this->option}&amp;{$token}=1&amp;task=contacts.delete&amp;cid[]={$item->id}");
            $arr['delete_link'] = JHtml::link($url, JText::sprintf('COM_COMPANIES_LINK_COMPANY_DELETE_CONTACT'));
            $result[] = $arr;
        }

        return $result;
    }

    /* Сортировка по умолчанию */
    protected function populateState($ordering = 'c.fio', $direction = 'asc')
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $for_accreditation = $this->getUserStateFromRequest($this->context . '.filter.for_accreditation', 'filter_for_accreditation', '', 'string');
        $this->setState('filter.for_accreditation', $for_accreditation);
        $for_building = $this->getUserStateFromRequest($this->context . '.filter.for_building', 'filter_for_building', '', 'string');
        $this->setState('filter.for_building', $for_building);
        parent::populateState($ordering, $direction);
        CompaniesHelper::check_refresh();
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.for_accreditation');
        $id .= ':' . $this->getState('filter.for_building');
        return parent::getStoreId($id);
    }

    private $export, $companyID;

}