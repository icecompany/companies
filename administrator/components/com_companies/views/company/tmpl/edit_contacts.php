<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_CONTACTS'); ?></h2></div>
<fieldset class="adminform">
    <div class="control-group form-inline">
        <?php foreach ($this->form->getFieldset('contacts') as $field) : ?>
            <?php if ($field->name == 'jform[phone_2]' || $field->name == 'jform[fax]'): ?>
                <hr class="hr_contacts">
            <?php endif; ?>
            <div class="control-label">
                <?php echo $field->label; ?>
            </div>
            <div class="controls">
                <?php echo $field->input; ?>
            </div>
            <?php if ($field->name == 'jform[site]'): ?>
                <a href="<?php echo $field->value;?>" target="_blank"><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_LINK_GO_TO_SITE');?></a>
            <?php endif;?>
            <?php if ($field->name == 'jform[email]'): ?>
                <a href="mailto:<?php echo $field->value;?>" target="_blank"><?php echo JText::sprintf('COM_COMPANIES_FORM_COMPANY_LINK_WRITE_EMAIL');?></a>
            <?php endif;?>
            <br>
        <?php endforeach; ?>
    </div>
</fieldset>
