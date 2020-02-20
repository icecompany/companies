<?php
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class CompaniesModelArmies extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'title',
                'for_contractor', 'contractor',
                'for_ndp', 'ndp',
                'weight',
            );
        }
        parent::__construct($config);
        $input = JFactory::getApplication()->input;
        $this->export = ($input->getString('task', 'display') !== 'export') ? false : true;
        $this->companyID = (!empty($config['companyID'])) ? $config['companyID'] : '';
    }

    protected function _getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query
            ->select("id, companyID, army_year, square_type, square_value, targets, thematics, stand, exposition, diversification, forum_new_items, full_new_items, is_ndp, is_report, comment")
            ->from("#__mkv_companies_army_history")
            ->order("army_year");
        $this->setState('list.limit', 0);

        if (is_numeric($this->companyID)) $query->where("companyID = {$this->companyID}");

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        $result = array('items' => array());
        foreach ($items as $item) {
            $arr = array();
            $arr['id'] = $item->id;
            $arr['army_year'] = $item->army_year;
            $arr['square_type'] = JText::sprintf("COM_COMPANIES_FORM_ARMY_SQUARE_TYPE_{$item->square_type}");
            $arr['square_value'] = JText::sprintf("COM_COMPANIES_MESSAGE_SQM", $item->square_value);
            $arr['square'] = ((int)$item->square_type !== 0) ? sprintf("%s (%s)", $arr['square_type'], $arr['square_value']) : $arr['square_type'];
            $arr['targets'] = $item->targets;
            $arr['thematics'] = $item->thematics;
            if ((int) $item->army_year !== 2020) {
                $arr['stand'] = $item->stand;
            }
            else {
                if (!empty($result['2020']['stand'])) $arr['stand'] .= "{$result['2020']['stand']}, {$item->stand}"; else $arr['stand'] = $item->stand;
            }
            $arr['exposition'] = $item->exposition;
            $arr['diversification'] = $item->diversification;
            $arr['forum_new_items'] = $item->forum_new_items;
            $arr['full_new_items'] = $item->full_new_items;
            $arr['is_ndp'] = JText::sprintf((!$item->is_ndp) ? 'JNO' : 'JYES');
            $arr['is_report'] = JText::sprintf("COM_COMPANIES_FORM_ARMY_IS_REPORT_{$item->is_report}");
            $arr['comment'] = $item->comment;
            $result['items'][] = $this->prepare($arr);
            if ((int) $item->army_year === 2020) $result['2020'] = $this->prepare($arr);
        }
        return $result;
    }

    private function prepare(array $item): array
    {
        if (!$this->export) {
            $return = CompaniesHelper::getReturnUrl();
            $canDo = true;
            if ($canDo) {
                $url = JRoute::_("index.php?option={$this->option}&amp;task=army.edit&amp;id={$item['id']}&amp;return={$return}");
                $title = $item['army_year'];
                $params = array('title' => $item['army_year'] ?? '');
                $item['army_year'] = JHtml::link($url, $title, $params);
            }
        }
        return $item;
    }

    private $export, $companyID;
}
