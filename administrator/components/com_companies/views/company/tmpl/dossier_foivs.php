<?php
defined('_JEXEC') or die;
?>
<div class="center"><h2><?php echo JText::sprintf('COM_COMPANIES_LAYOUT_COMPANY_FOIVS'); ?></h2></div>
<?php if (!empty($this->foivs)) { ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th style="width: 30%;"><?php echo JText::sprintf('COM_COMPANIES_HEAD_FOIV');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_FOIV_DEPARTMENT');?></th>
            <th><?php echo JText::sprintf('COM_COMPANIES_HEAD_COMMENT');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->foivs as $foiv): ?>
            <tr>
                <td><?php echo $foiv['foiv'];?></td>
                <td><?php echo $foiv['department'];?></td>
                <td><?php echo $foiv['comment'];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {echo JText::sprintf('COM_COMPANIES_MESSAGE_NO_INFO');} ?>
