<?php 
/*@var $this Mouf\Utils\Mailer\Controllers\DBMailServiceListController */
?>
<script type="text/javascript">
function setIframeHeight(height) {
	jQuery("#htmlBodyMail").height(height);
}
</script>
<style>
iframe#htmlBodyMail {
	border: solid 1px #cccccc;
}
pre#textbody {
	border: solid 1px #cccccc;
}
</style>
<?php mailViewDisplayBackButton($this); ?>
<h1>Mail detail</h1>
<form class="form-horizontal">

<div class="control-group">
	<label class="control-label">From:</label>
	<div class="controls"><?php echo '<a href="mailto:'.$this->mail->getFrom()->getMail().'">'.plainstring_to_htmlprotected($this->mail->getFrom()).'</a>'; ?></div>
</div>
<?php
displayMailAddresses($this->mail->getToRecipients(), "To");
displayMailAddresses($this->mail->getCcRecipients(), "Cc");
displayMailAddresses($this->mail->getBccRecipients(), "Bcc");
?>
<div class="control-group">
	<label class="control-label">Title:</label>
	<div class="controls">
	<?php echo plainstring_to_htmlprotected($this->mail->getTitle()); ?>
	</div>
</div>
<div class="control-group">
	<label class="control-label">Date:</label>
	<div class="controls"><?php echo date('r', $this->mail->getDateSent()); ?></div>
</div>
</form>

<?php if ($this->mail->getBodyHtml()) { ?>
<div>
<iframe id="htmlBodyMail" width="100%" height="300" src="getHtmlBody?id=<?php echo $this->mail->getDbId() ?>&selfedit=<?php echo $this->selfedit ?>&instanceName=<?php echo plainstring_to_urlprotected($this->instanceName) ?>"></iframe>
</div>
<?php } ?>

<div>
<?php if ($this->mail->getBodyText()) { ?>
<a href="#" id="toggletextmessage">View/hide text message</a>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#toggletextmessage").click(function() {
		jQuery("#textbody").toggle();
		return false;
	});
	jQuery("#textbody").hide();
});
</script>
<?php } ?>
<pre id="textbody">
<?php echo $this->mail->getBodyText(); ?>
</pre>
</div>

<?php 
mailViewDisplayBackButton($this);

function displayMailAddresses(array $mailAddressList, $label) {
	if (!empty($mailAddressList)) {
?>
	<div class="control-group">
	<label class="control-label"><?php echo $label ?>:</label>
	<div class="controls">
	<?php
	$mails = array();
	foreach ($mailAddressList as $recipient) {
		$mails[] = '<a href="mailto:'.$recipient->getMail().'">'.plainstring_to_htmlprotected($recipient).'</a>';
	}
	echo implode(", ", $mails);
	?>
	</div>
	</div>
<?php 
	}
}

function mailViewDisplayBackButton($controller) {
?>
<form action="." method="get">
	<input type="hidden" name="instanceName" value="<?php echo plainstring_to_htmlprotected($controller->instanceName); ?>" />
	<input type="hidden" name="selfedit" value="<?php echo plainstring_to_htmlprotected($controller->selfedit); ?>" />
	<input type="hidden" name="fullTextSearch" value="<?php echo plainstring_to_htmlprotected($controller->fullTextSearch); ?>" />
	<input type="hidden" name="offset" value="<?php echo plainstring_to_htmlprotected($controller->offset); ?>" />
	<button type="submit" class="btn btn-danger">&lt; Back</button>
</form>
<?php 
}
?>