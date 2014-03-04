<?php 
use Mouf\Utils\Mailer\Controllers\DBMailServiceListController;
/*@var $this Mouf\Utils\Mailer\Controllers\DBMailServiceListController */
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("table.mails tr").click(function(evt) {
		var mailId = evt.currentTarget.getAttribute("data-mailid");
		window.location = "<?php echo ROOT_URL ?>dbmailservice/view?id="+mailId+"&selfedit=<?php echo $this->selfedit ?>&instanceName=<?php echo plainstring_to_urlprotected($this->instanceName) ?>&fullTextSearch=<?php echo plainstring_to_urlprotected($this->fullTextSearch) ?>&offset=<?php echo plainstring_to_urlprotected($this->offset) ?>";
	});
});
</script>

<style>
table.mails tr:hover {
	cursor: pointer;
}
</style>

<h1>Outgoing mails</h1>
<form>
	<input type="hidden" name="instanceName" value="<?php echo plainstring_to_htmlprotected($this->instanceName); ?>" />
	<input type="hidden" name="selfedit" value="<?php echo plainstring_to_htmlprotected($this->selfedit); ?>" />
	<div class="control-group">
	<label for="fullTextMailSearch">Search:</label>
	<input type="text" name="fullTextSearch" id="fullTextMailSearch" value="<?php echo plainstring_to_htmlprotected($this->fullTextSearch); ?>" class="search-query" />
	<button name="search" value="" type="submit" class="btn">Search</button>
	</div>

<table class="mails table table-striped table-hover" >
	<tr>
		<th style="width:10%">Category:</th>
		<th style="width:10%">Type:</th>
		<th style="width:20%">To / CC / BCC:</th>
		<th style="width:45%">Title:</th>
		<th style="width:15%">Date:</th>
	</tr>
<?php foreach ($this->mailList as $mail): ?>
	<tr data-mailid="<?php echo $mail['id']; ?>">
		<td title="<?php echo plainstring_to_htmlprotected($mail['category']); ?>"><?php echo plainstring_to_htmlprotected($mail['category']); ?></td>
		<td title="<?php echo plainstring_to_htmlprotected($mail['mail_type']); ?>"><?php echo plainstring_to_htmlprotected($mail['mail_type']); ?></td>
		<td title="<?php echo plainstring_to_htmlprotected($mail['tos']); ?>"><?php echo plainstring_to_htmlprotected($mail['tos']); ?></td>
		<td title="<?php echo plainstring_to_htmlprotected($mail['title']); ?>"><?php echo plainstring_to_htmlprotected($mail['title']); ?></td>
		<td title="<?php echo plainstring_to_htmlprotected($mail['sent_date']); ?>"><?php echo plainstring_to_htmlprotected($mail['sent_date']); ?></td>
	</tr>
<?php endforeach; ?>
</table>
<div class="control-group">
<?php if ($this->offset > 0): ?>
	<button name="offset" value="<?php echo $this->offset - DBMailServiceListController::PAGE_SIZE ?>" type="submit" class="btn">Previous</button>
<?php endif; ?>
<?php if (count($this->mailList) == DBMailServiceListController::PAGE_SIZE): ?>
	<button name="offset" value="<?php echo $this->offset + DBMailServiceListController::PAGE_SIZE ?>" type="submit" class="btn">Next</button>
<?php endif; ?>
</div>
</form>
