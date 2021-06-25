<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('title')
	->set_type('textarea')
	->set_label('Заголовок')
	->set_value('Заголовок слайда')
	->set_required()
	->create(); ?>
	
<?=$this->admincreator
	->set_name('text')
	->set_type('textarea')
	->set_label('Описание')
	->create(); ?>

<?=$this->admincreator
	->set_name('btn')
	->set_label('Текст кнопки')
	->set_value('Подробнее')
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Изображения</div>

<? foreach($imgs as $img) { ?>
	<?=$this->admincreator
		->set_name($img['name'])
		->set_type('file')
		->set_label($img['title'])
		->label_info('Рекомендуемый размер не меньше '.$img['x'].'x'.$img['y'])
		->create(); ?>
<? } ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Настройки слайда</div>

<?=$this->admincreator
	->set_name('link')
	->set_label('Ссылка')
	->create(); ?>

<?=$this->admincreator
	->set_name('align')
	->set_type('select')
	->set_label('Выравнивание')
	->set_options($aligns)
	->set_value('left')
	->create(); ?>

<?=$this->admincreator
	->set_name('num')
	->set_label('Приоритет')
	->set_params(['type' => 'number', 'min' => 1])
	->set_value(1)
	->create(); ?>
	
<?=$this->admincreator
	->set_name('show_text')
	->set_type('checkbox')
	->set_label('Отображать текст')
	->set_value(true)
	->create(); ?>
	
<?=$this->admincreator
	->set_name('visibility')
	->set_type('checkbox')
	->set_label('Отображать на сайте')
	->set_value(true)
	->create(); ?>
	
<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_add();?>
	<?=btn_link_back($this->page);?>
</div>
<?=form_close();?>
