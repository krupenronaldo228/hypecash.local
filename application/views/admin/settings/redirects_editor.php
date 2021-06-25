<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<? $text = null;

foreach ($items as $item) {
	$text .= $item['url_from'] . ' ' . $item['url_to'] . "\r\n";
} ?>

<?=action_result('info', fa('info-circle mr5').' Каждый новый редирект с новой строки. Исходный и конечный URL-ы разделяются одним пробелом.')?>

<div class="form-group">
	<textarea name="redirects" rows="30" class="form-input" style="font-family: 'Courier New', Arial, monospace;"><?=$text;?></textarea>
</div>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_save();?>
	<?=btn_save_exit();?>
	<?=btn_link_back($this->page.'/redirects');?>
</div>

<?=form_close();?>
