<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_FACT_ADDRESS');?></h2></div>
<fieldset class="adminform">
    <div class="control-group form-inline">
        <?php foreach ($this->form->getFieldset('fact_address') as $field) : ?>
            <div class="control-label">
                <?php echo $field->label;?>
            </div>
            <div class="controls">
                <?php echo $field->input;?>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
</fieldset>