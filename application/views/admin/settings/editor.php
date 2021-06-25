<?=form_open('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<div class="mb30">
	<textarea class="form-input form-input-code" name="text" rows="10"><?=set_value('text', $file);?></textarea>
</div>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_save();?>
    <?=btn_save_exit();?>
    <?=btn_link_back($this->page);?>
</div>

<?=form_close();?>
