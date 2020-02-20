<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_DOSSIER_EXHIBITORS_ARMY_2020');?></h2></div>
<?php
if (empty($this->item->armies['2020'])) {
    echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_DATA_ARMY_2020');
    return;
}
?>
<table class="table table-stripped">
    <tbody>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_STAND');?></td>
            <td><?php echo $this->item->armies['2020']['stand'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_THEMATICS');?></td>
            <td><?php echo $this->item->armies['2020']['thematics'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_TARGETS');?></td>
            <td><?php echo $this->item->armies['2020']['targets'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_EXPOSITION');?></td>
            <td><?php echo $this->item->armies['2020']['exposition'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_DIVERSIFICATION');?></td>
            <td><?php echo $this->item->armies['2020']['diversification'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FORUM_NEW_ITEMS');?></td>
            <td><?php echo $this->item->armies['2020']['forum_new_items'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FULL_ITEMS');?></td>
            <td><?php echo $this->item->armies['2020']['full_new_items'];?></td>
        </tr>
        <tr>
            <td><?php echo JText::sprintf('COM_COMPANIES_HEAD_ARMY_FORUM_IS_NDP');?></td>
            <td><?php echo $this->item->armies['2020']['is_ndp'];?></td>
        </tr>
    </tbody>
</table>