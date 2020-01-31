<?php
defined('_JEXEC') or die;
?>
<div>
    <?php echo $this->links['contact_add'];?>
</div>
<table class="table table-stripped">
    <thead><?php echo $this->loadTemplate('persons_head');?></thead>
    <tbody><?php echo $this->loadTemplate('persons_body');?></tbody>
    <tfoot><?php echo $this->loadTemplate('persons_foot');?></tfoot>
</table>