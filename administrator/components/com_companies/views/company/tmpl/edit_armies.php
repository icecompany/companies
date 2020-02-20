<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_DOSSIER_EXHIBITORS_HISTORY');?></h2></div>
<div>
    <?php echo $this->links['army_add'];?>
</div>
<table class="table table-stripped">
    <thead><?php echo $this->loadTemplate('armies_head');?></thead>
    <tbody><?php echo $this->loadTemplate('armies_body');?></tbody>
    <tfoot><?php echo $this->loadTemplate('armies_foot');?></tfoot>
</table>
<div>
    <?php echo $this->loadTemplate('armies_2020');?>
</div>
