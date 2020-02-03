<?php

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelContacts extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'companyID',
                'fio',
                'for_building',
                'for_accreditation',
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
            ->select("aes_decrypt(c.phone_work,@pass) as phone_work")
            ->select("aes_decrypt(c.phone_mobile,@pass) as phone_mobile")
            ->select("aes_decrypt(c.email,@pass) as email")
            ->from("#__mkv_companies_contacts c");
        if ($this->companyID > 0) {
            $query->where("c.companyID = {$this->companyID}");
        }
        $this->setState('list.limit', 0);

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
            $arr['phone_work'] = $item->phone_work;
            $arr['phone_mobile'] = $item->phone_mobile;
            $arr['email'] = $item->email;
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

    private $export, $companyID;

}