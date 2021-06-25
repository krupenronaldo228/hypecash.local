<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('key')
	->set_type('select')
	->set_label('Иконка')
	->set_options($keys)
	->set_value($item['key'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('link')
	->set_label('Ссылка')
	->set_required()
	->set_value($item['link'])
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Настройки</div>

<?=$this->admincreator
	->set_name('num')
	->set_label('Приоритет')
	->set_value($item['num'])
	->create(); ?>

<?=$this->admincreator
	->set_name('visibility')
	->set_type('checkbox')
	->set_label('Отображать на сайте')
	->set_value($item['visibility'] == 1)
	->create(); ?>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_save();?>
	<?=btn_save_exit();?>
	<?=btn_link_back($this->page);?>
</div>
<?=form_close();?>
