<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

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
	->set_required()
	->create(); ?>
	
<?=$this->admincreator
	->set_name('text')
	->set_type('textarea')
	->set_label('Текст')
	->set_value($item['text'])
	->set_editor(true)
	->create(); ?>

<?=$this->admincreator
	->set_name('img')
	->set_type('file')
	->set_label('Изображение')
	->label_info('Рекомендуемый размер не меньше '.$size['x'].'x'.$size['y'])
	->file_origin($item['img'], PATH_UPLOADS.'/'.$folder.'/thumb')
	->file_delete('admin/'.$this->page.'/ajaxImageDelete/'.$item['id'])
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">SEO</div>

<?=$this->admincreator
	->set_name('alias')
	->set_label('Ссылка (ЧПУ)')
	->set_value($item['alias'])
	->set_required()
	->input_info('<a href="javascript:void(0)" class="h6" data-toggle="translate_title">перевести заголовок</a>')
	->create(); ?>

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

<?=$this->admincreator
	->set_name('img_alt')
	->set_label('Alt изображения')
	->set_value($item['img_alt'])
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Настройки</div>

<div class="row">
	<div class="col-xl-3 col-lg-3">
		<label class="form-labelblock" for="admin_input_date">
			Дата
		</label>
	</div>
	<div class="col-xl-9 col-lg-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text"><?=fa5r('calendar-alt fa-fw');?></span>
						</span>
						<input type="text" class="form-input" name="date" readonly data-toggle="datepicker" value="<?=set_value('date', date('d.m.Y', strtotime($item['pub_date'])));?>" placeholder="Дата" id="admin_input_date" />
					</div>
					<?=form_error('date'); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text"><?=fa5r('clock fa-fw');?></span>
						</span>
						<input type="text" class="form-input" name="time" value="<?=set_value('time', date('H:i', strtotime($item['pub_date'])));?>" placeholder="Время" />
					</div>
					<?=form_error('time'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

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

<script>
	$('[data-toggle="datepicker"]').datepicker();
	$('[name="time"]').inputmask('99:99');
</script>
