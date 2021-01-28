<?php
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Table;

defined('_JEXEC') or die;

class CompaniesHelper
{
	public function addSubmenu($vName)
	{
	    PrjHelper::addNotifies();
		HTMLHelper::_('sidebar.addEntry', JText::sprintf('COM_COMPANIES_MENU_COMPANIES'), 'index.php?option=com_companies&amp;view=companies', $vName === 'companies');
		HTMLHelper::_('sidebar.addEntry', JText::sprintf('COM_COMPANIES_MENU_CONTACTS'), 'index.php?option=com_companies&amp;view=contacts', $vName === 'contacts');
		if (self::canDo('core.access.activities')) {
            HTMLHelper::_('sidebar.addEntry', JText::sprintf('COM_COMPANIES_MENU_ACTIVITIES'), 'index.php?option=com_companies&amp;view=activities', $vName === 'activities');
        }
		if (self::canDo('core.access.complain')) {
            HTMLHelper::_('sidebar.addEntry', JText::sprintf('COM_COMPANIES_MENU_COMPLAIN'), 'index.php?option=com_companies&amp;view=complain', $vName === 'complain');
        }
	}

    /**
     * Возвращает год текущего активного проекта
     * @return int
     *
     * @since version 2.4.0
     */
    public static function getYearOfCurrentProject(): int
    {
        $current = PrjHelper::getActiveProject(MkvHelper::getConfig('default_project'));
        if (!is_numeric($current)) return 0;
        JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_prj/tables");
        $table = JTable::getInstance("Projects", "TablePrj");
        $table->load($current);
        return JDate::getInstance($table->date_start)->year ?? 0;
	}

    /**
     * Генерирует строку с адресом
     * @param string $index индекс
     * @param string $city город или ID города из нашей базы
     * @param string $street улица
     * @param string $home дом
     *
     * @return string строка с адресом
     *
     * @since version 2.4.0
     */
    public static function getAddress(string $index = '', string $city = '', string $street = '', string $home = ''): string
    {
        if (is_numeric($city)) {
            JTable::addIncludePath(JPATH_ADMINISTRATOR . "/components/com_geography/tables");
            $table = JTable::getInstance("Cities", "TableGeography");
            $table->load((int) $city);
            $city = $table->name;
        }
        $addr = [];
        foreach ([$index, $city, $street, $home] as $elem) {
            if (!empty($elem)) $addr[] = $elem;
        }
        return implode(', ', $addr);
	}

    /**
     * Проверяет необходимость перезагрузить страницу. Используется для возврата на предыдущую страницу при отправке формы в админке
     * @throws Exception
     * @since 1.0.4
     */
    public static function check_refresh(): void
    {
        $refresh = JFactory::getApplication()->input->getBool('refresh', false);
        if ($refresh) {
            $current = JUri::getInstance(self::getCurrentUrl());
            $current->delVar('refresh');
            JFactory::getApplication()->redirect($current);
        }
    }

    /**
     * Возвращает параметр ID из реферера
     * @since 1.0.1
     * @return int ID Элемента
     */
    public static function getItemID(): int
    {
        $uri = JUri::getInstance($_SERVER['HTTP_REFERER']);
        return (int) $uri->getVar('id') ?? 0;
	}

    /**
     * Возвращает URL для обработки формы
     * @return string
     * @since 1.0.0
     * @throws
     */
    public static function getActionUrl(): string
    {
        $uri = JUri::getInstance();
        $uri->setVar('refresh', '1');
        $query = $uri->getQuery();
        $client = (!JFactory::getApplication()->isClient('administrator')) ? 'site' : 'administrator';
        return JRoute::link($client, "index.php?{$query}");
    }

    /**
     * Возвращает текущий URL
     * @return string
     * @since 1.0.0
     * @throws
     */
    public static function getCurrentUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        return "index.php?{$query}";
    }

    /**
     * Возвращает URL для возврата (текущий адрес страницы)
     * @return string
     * @since 1.0.0
     */
    public static function getReturnUrl(): string
    {
        $uri = JUri::getInstance();
        $query = $uri->getQuery();
        return base64_encode("index.php?{$query}");
    }

    /**
     * Возвращает URL для обработки формы левой панели
     * @return string
     * @since 1.0.0
     */
    public static function getSidebarAction():string
    {
        $return = self::getReturnUrl();
        return JRoute::_("index.php?return={$return}");
    }

    public static function canDo(string $action): bool
    {
        return JFactory::getUser()->authorise($action, 'com_companies');
    }

    public static function getConfig(string $param, $default = null)
    {
        $config = JComponentHelper::getParams("com_companies");
        return $config->get($param, $default);
    }
}
