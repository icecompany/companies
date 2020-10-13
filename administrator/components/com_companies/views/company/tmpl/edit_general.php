<?php
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
    <div class="control-group form-inline">
        <?php foreach ($this->form->getFieldset('general') as $field) : ?>
            <?php if ($field->name == 'jform[director_name]' || $field->name == 'jform[comment]' || $field->name == 'jform[activities][]'): ?>
                <hr class="hr_contacts">
            <?php endif;?>
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
