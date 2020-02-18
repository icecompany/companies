<?php
defined('_JEXEC') or die;
?>
<div class="center"><h6><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_DOSSIER_SISTERS');?></h6></div>
<table class="table table-stripped">
    <thead><?php echo $this->loadTemplate('sisters_head');?></thead>
    <tbody><?php echo $this->loadTemplate('sisters_body');?></tbody>
    <tfoot><?php echo $this->loadTemplate('sisters_foot');?></tfoot>
</table>