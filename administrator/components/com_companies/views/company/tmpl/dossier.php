<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

?>
<p><h1><?php echo $this->item->title; ?></h1></p>
<p>
    <strong>Юр. адрес:</strong> <?php echo CompaniesHelper::getAddress($this->item->legal_index ?? '', $this->item->legal_city ?? '', $this->item->legal_street ?? '', $this->item->legal_house ?? '');?>
    <br>
    <strong>Факт. адрес:</strong> <?php echo CompaniesHelper::getAddress($this->item->fact_index ?? '', $this->item->fact_city ?? '', $this->item->fact_street ?? '', $this->item->fact_house ?? '');?>
    <br>
    <strong>Главный офис:</strong> <?php echo CompaniesHelper::getAddress($this->item->main_office_index ?? '', $this->item->main_office_city ?? '', $this->item->main_office_street ?? '', $this->item->main_office_house ?? '');?>
    <br>
    <strong>Представительство в Москве:</strong> <?php echo CompaniesHelper::getAddress($this->item->moscow_office_index ?? '', '', $this->item->moscow_office_street ?? '', $this->item->moscow_office_house ?? '');?>
    <br>
    <strong><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_REPRESENTATIONS_DESC');?>:</strong> <?php echo $this->item->representations;?>
</p>
<p>
    <strong><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_DIRECTOR_NAME_LABEL');?>:</strong> <?php echo $this->item->director_name;?>
    <br>
    <strong><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_DIRECTOR_POST_LABEL');?>:</strong> <?php echo $this->item->director_post;?>
    <br>
    <strong><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_PARENT_LABEL');?>:</strong> <?php echo $this->item->hidden_parent_title;?>
    <br>
    <strong><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_ASSOCIATIONS_DESC');?>:</strong> <?php echo $this->item->associations;?>
</p>
<p>
    <div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_OUR_PROJECTS'); ?></h2></div>
    <?php echo $this->loadTemplate('contracts');?>
</p>