<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('script', $this->script);
?>
<script type="text/javascript">
    Joomla.submitbutton = function (task) {
        if (task === 'contact.cancel' || document.formvalidator.isValid(document.querySelector('#adminForm'))) {
            let fields = document.querySelectorAll("#adminForm input[type='text']");
            fields.forEach(function(elem) {
                elem.value = elem.value.trim();
            });
            Joomla.submitform(task, document.querySelector('#adminForm'));
        }
    }
</script>
<form action="<?php echo CompaniesHelper::getActionUrl(); ?>"
      method="post" name="adminForm" id="adminForm" xmlns="http://www.w3.org/1999/html" class="form-validate">
    <div class="row-fluid">
        <div class="span12 form-horizontal">
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general', 'useCookie' => true)); ?>
            <div class="tab-content">
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::sprintf('COM_COMPANIES_TAB_CONTACT_GENERAL')); ?>
                <div class="row-fluid">
                    <div class="span6">
                        <div><?php echo $this->loadTemplate('general'); ?></div>
                    </div>
                    <div class="span6">
                        <div><?php echo $this->loadTemplate('advanced'); ?></div>
                    </div>
                </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            </div>
            <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        </div>
        <div>
            <input type="hidden" name="task" value=""/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>

