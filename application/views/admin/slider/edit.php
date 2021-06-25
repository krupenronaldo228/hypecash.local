<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('title')
	->set_type('textarea')
	->set_label('Заголовок')
	->set_value($item['title'])
	->set_required()
	->create(); ?>
	
<?=$this->admincreator
	->set_name('text')
	->set_type('textarea')
	->set_label('Описание')
	->set_value($item['text'])
	->create(); ?>

<?=$this->admincreator
	->set_name('btn')
	->set_label('Текст кнопки')
	->set_value($item['btn'])
	->create(); ?>


<hr class="mt30 mb30" />

<div class="h3 bold mb20">Изображения</div>

<? foreach($imgs as $img) { ?>
	<?=$this->admincreator
		->set_name($img['name'])
		->set_type('file')
		->set_label($img['title'])
		->label_info('Рекомендуемый размер не меньше '.$img['x'].'x'.$img['y'])
		->file_origin($item[$img['name']], PATH_UPLOADS.'/'.$folder.'/thumb')
		->create(); ?>
<? } ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Настройки слайда</div>

<?=$this->admincreator
	->set_name('link')
	->set_label('Ссылка')
	->set_value($item['link'])
	->create(); ?>

<?=$this->admincreator
	->set_name('align')
	->set_type('select')
	->set_label('Выравнивание')
	->set_options($aligns)
	->set_value($item['align'])
	->create(); ?>

<?=$this->admincreator
	->set_name('num')
	->set_label('Приоритет')
	->set_params(['type' => 'number', 'min' => 1])
	->set_value($item['num'])
	->create(); ?>
	
<?=$this->admincreator
	->set_name('show_text')
	->set_type('checkbox')
	->set_label('Отображать текст')
	->set_value($item['show_text'] == 1)
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
