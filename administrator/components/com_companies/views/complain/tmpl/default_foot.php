<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
$colspan = '5';?>
<tr>
    <td colspan="<?php echo $colspan;?>"><?php echo $this->pagination->getListFooter(); ?></td>
</tr>