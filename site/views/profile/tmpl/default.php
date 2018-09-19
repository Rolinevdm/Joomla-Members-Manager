<?php
/**
 * @package    Joomla.Members.Manager
 *
 * @created    6th September, 2015
 * @author     Llewellyn van der Merwe <https://www.joomlacomponentbuilder.com/>
 * @github     Joomla Members Manager <https://github.com/vdm-io/Joomla-Members-Manager>
 * @copyright  Copyright (C) 2015. All Rights Reserved
 * @license    GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.modal');

?>

<?php if ($this->user->id > 0): ?>
	<a class="uk-button uk-width-1-1 uk-button-primary uk-button-small uk-margin-small-bottom" href="<?php echo MembersmanagerHelperRoute::getCpanelRoute(); ?>" title="<?php echo JText::_('COM_MEMBERSMANAGER_OPEN_CPANEL'); ?>">
		<?php echo JText::_('COM_MEMBERSMANAGER_BACK_TO_CPANEL'); ?>
	</a>
	<?php echo $this->loadTemplate('profiles'); ?>
	<script type="text/javascript">
		// token 
		var token = '<?php echo JSession::getFormToken(); ?>';
		
		function printMe(name, printDivId) {
			printWindow = window.open('','printwindow', "location=1,status=1,scrollbars=1");
			if(!printWindow)alert('<?php echo JText::_('COM_MEMBERSMANAGER_PLEASE_ENABLE_POPUPS_IN_YOUR_BROWSER_FOR_THIS_WEBSITE_TO_PRINT_THESE_DETAILS'); ?>');
			printWindow.document.write('<html moznomarginboxes mozdisallowselectionprint><head><title>'+name+'</title><link rel="stylesheet" type="text/css" href="<?php echo JURI::root(); ?>media/com_membersmanager/uikit-v2/css/uikit.css">');
			printWindow.document.write('<link rel="stylesheet" type="text/css" href="<?php echo JURI::root(); ?>media/com_membersmanager/css/A4.print.css">');
			//Print and cancel button
			printWindow.document.write('</head><body >');
			printWindow.document.write('<div class="uk-button-group uk-width-1-1 no-print"><button type="button" class="uk-button uk-width-1-2 uk-button-success" onclick="window.print(); window.close();" ><i class="uk-icon-print"></i> <?php echo JText::_('COM_MEMBERSMANAGER_PRINT_CLOSE'); ?></button>');
			printWindow.document.write('<button type="button" class="uk-button uk-width-1-2 uk-button-danger" onclick="window.close();"><i class="uk-icon-close"></i> <?php echo JText::_('COM_MEMBERSMANAGER_CLOSE'); ?></button></div><page size="A4">');
			printWindow.document.write(jQuery('#'+printDivId).html());
			printWindow.document.write('</page></body></html>');
			printWindow.document.close();
			printWindow.focus()
		}
		
<?php
	$app = JFactory::getApplication();
?>
function JRouter(link) {
<?php
	if ($app->isSite())
	{
		echo 'var url = "'.JURI::root().'";';
	}
	else
	{
		echo 'var url = "";';
	}
?>
	return url+link;
} 
		
// nice little dot trick :)
jQuery(document).ready( function($) {
  var x=0;
  setInterval(function() {
	var dots = "";
	x++;
	for (var y=0; y < x%8; y++) {
		dots+=".";
	}
	$(".loading-dots").text(dots);
  } , 500);
});
	</script>
<?php else: ?>
	<?php echo $this->loadTemplate('loginmodule'); ?>
<?php endif; ?>