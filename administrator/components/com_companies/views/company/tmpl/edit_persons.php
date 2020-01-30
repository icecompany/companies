<?php
defined('_JEXEC') or die;
?>
<table class="table table-stripped">
    <thead><?php echo $this->loadTemplate('persons_head');?></thead>
    <tbody><?php echo $this->loadTemplate('persons_body');?></tbody>
    <tfoot><?php echo $this->loadTemplate('persons_foot');?></tfoot>
</table>