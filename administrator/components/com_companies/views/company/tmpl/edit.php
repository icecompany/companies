<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('script', 'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js', array('relative' => true));
HTMLHelper::_('script', $this->script);
HTMLHelper::_('stylesheet', 'com_companies/style.css', array('version' => 'auto', 'relative' => true));
?>
<form action="<?php echo CompaniesHelper::getActionUrl(); ?>"
      method="post" name="adminForm" id="adminForm" xmlns="http://www.w3.org/1999/html" class="form-validate">
    <div class="row-fluid">
        <div class="span12 form-horizontal">
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general', 'useCookie' => true)); ?>
            <div class="tab-content">
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::sprintf('COM_COMPANIES_TAB_COMPANY_GENERAL')); ?>
                <div class="row-fluid">
                    <div class="span4">
                        <div><?php echo $this->loadTemplate('params'); ?></div>
                        <div><?php echo $this->loadTemplate('general'); ?></div>
                    </div>
                    <div class="span4">
                        <div><?php echo $this->loadTemplate('legal_address'); ?></div>
                        <div><?php echo $this->loadTemplate('fact_address'); ?></div>
                        <div><?php echo $this->loadTemplate('contacts'); ?></div>
                    </div>
                    <div class="span4">
                        <div><?php echo $this->loadTemplate('active_contracts'); ?></div>
                        <div><?php echo $this->loadTemplate('bank'); ?></div>
                    </div>
                </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php if ($this->item->id !== null): ?>
                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'children', JText::sprintf('COM_COMPANIES_TAB_COMPANY_CHILDREN')); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div><?php echo $this->loadTemplate('children'); ?></div>
                        </div>
                    </div>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php endif;?>
                <?php if ($this->item->id !== null): ?>
                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'persons', JText::sprintf('COM_COMPANIES_TAB_COMPANY_CONTACTS')); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div><?php echo $this->loadTemplate('persons'); ?></div>
                        </div>
                    </div>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php endif;?>
                <?php if ($this->item->id !== null && CompaniesHelper::canDo('core.access.dossier')): ?>
                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'dossier', JText::sprintf('COM_COMPANIES_TAB_COMPANY_DOSSIER')); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div><?php echo $this->loadTemplate('dossier'); ?></div>
                        </div>
                    </div>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php endif;?>
            </div>
            <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        </div>
        <div>
            <input type="hidden" name="task" value=""/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>

