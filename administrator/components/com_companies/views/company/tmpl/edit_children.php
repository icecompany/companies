<?php
defined('_JEXEC') or die;
?>
<table class="table table-stripped">
    <thead><?php echo $this->loadTemplate('children_head');?></thead>
    <tbody><?php echo $this->loadTemplate('children_body');?></tbody>
    <tfoot><?php echo $this->loadTemplate('children_foot');?></tfoot>
</table>