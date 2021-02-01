<?php
defined('_JEXEC') or die;
?>
<div>
    <div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_FORM_ARMY_TARGETS_DESC'); ?></h2></div>
    <div><?php echo $this->item->targets ?? JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');?></div>
</div>
<div><?php echo $this->loadTemplate('foivs');?></div>
<div><?php echo $this->loadTemplate('regions');?></div>
<div><?php echo $this->loadTemplate('clients');?></div>
<div><?php echo $this->loadTemplate('cooperations');?></div>
<div><?php echo $this->loadTemplate('partners');?></div>
<div><?php echo $this->loadTemplate('competitors');?></div>
