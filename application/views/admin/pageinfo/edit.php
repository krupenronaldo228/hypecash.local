<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('name')
	->set_label('Название')
	->set_value($item['name'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('title')
	->set_label('Заголовок')
	->set_value($item['title'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('brief')
	->set_type('textarea')
	->set_label('Краткое описание')
	->set_value($item['brief'])
	->create(); ?>
	
<?=$this->admincreator
	->set_name('text')
	->set_type('textarea')
	->set_label('Текст')
	->set_value($item['text'])
	->set_editor()
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">SEO</div>

<?=$this->admincreator
	->set_name('meta_title')
	->set_label('Meta Title')
	->set_value($item['meta_title'])
	->set_required()
	->set_params(['data-toggle' => 'strcount', 'data-strcount-needle' => META_TITLE_TOTAL, 'data-strcount-allow' => META_TITLE_ALLOW, 'maxlenght' => 255])
	->input_info('<a href="javascript:void(0)" class="h6" data-toggle="copy_title">скопировать заголовок</a>')
	->label_info('<div class="form-counter" data-strcount="meta_title"></div>')
	->create(); ?>

<?=$this->admincreator
	->set_name('meta_description')
	->set_type('textarea')
	->set_label('Meta Description')
	->set_value($item['meta_description'])
	->set_params(['data-toggle' => 'strcount', 'data-strcount-needle' => META_DESCRIPTION_TOTAL, 'data-strcount-allow' => META_DESCRIPTION_ALLOW])
	->label_info('<div class="form-counter" data-strcount="meta_description"></div>')
	->create(); ?>
	
<? if($item['thumb_enable']) { ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Изображения</div>

<?=$this->admincreator
	->set_name('thumb_x')
	->set_label('Ширина эскизов (px)')
	->set_value($item['thumb_x'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('thumb_y')
	->set_label('Высота эскизов (px)')
	->set_value($item['thumb_y'])
	->set_required()
	->create(); ?>
	
<? } ?>

<hr class="mt30 mb30" />

<div class="btns-list">
   <?=btn_save();?>
    <?=btn_save_exit();?>
    <?=btn_link_back($this->page);?>
</div>

<?=form_close();?>