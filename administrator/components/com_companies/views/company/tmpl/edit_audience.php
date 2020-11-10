<?php
defined('_JEXEC') or die;
?>
<div class="row-fluid">
    <div class="span12">
        <fieldset class="adminform">
            <div class="control-group form-inline">
                <?php foreach ($this->form->getFieldset('audience') as $field) : ?>
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
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <?php echo $this->loadTemplate('foivs');?>
        </div>
        <div class="span6">

        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <?php echo $this->loadTemplate('clients');?>
        </div>
        <div class="span6">
            <?php echo $this->loadTemplate('cooperations');?>
        </div>
    </div>
</div>
