<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('url_from')
	->set_label('Исходный URL')
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('url_to')
	->set_label('Конечный URL')
	->set_required()
	->create(); ?>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_add();?>
	<?=btn_link_back($this->page.'/redirects');?>
</div>

<?=form_close();?>