<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('title')
	->set_label('Название сайта')
	->set_value($siteinfo['title'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('description')
	->set_label('Описание сайта')
	->set_value($siteinfo['description'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('owner')
	->set_label('Владелец сайта')
	->set_value($siteinfo['owner'])
	->create(); ?>

<?=$this->admincreator
	->set_name('details')
	->set_type('textarea')
	->set_label('Реквизиты')
	->set_value($siteinfo['details'])
	->create(); ?>

<?=$this->admincreator
	->set_name('copyright')
	->set_type('textarea')
	->set_label('Копирайт')
	->set_value($siteinfo['copyright'])
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Контакты</div>

<?=$this->admincreator
	->set_name('email')
	->set_label('E-mail')
	->set_value($siteinfo['email'])
	->set_required()
	->create(); ?>
	
<div class="row">
	<div class="col-xl-3 col-lg-3">
		<label class="form-labelblock" for="phone">
			Телефон (основной): <span class="required">*</span>
		</label>
	</div>
	<div class="col-xl-9 col-lg-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="phone" id="phone" value="<?=set_value('phone', $siteinfo['phone']);?>" />
					<?=form_error('phone'); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="mask_phone" value="<?=set_value('mask_phone', htmlspecialchars_decode($siteinfo['mask_phone']));?>" readonly />
					<?=form_error('mask_phone'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-lg-3">
		<label class="form-labelblock" for="phone_extra">
			Телефон (дополнительный):
		</label>
	</div>
	<div class="col-xl-9 col-lg-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="phone_extra" id="phone_extra" value="<?=set_value('phone_extra', $siteinfo['phone_extra']);?>" />
					<?=form_error('phone_extra'); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="mask_phone_extra" value="<?=set_value('mask_phone_extra', htmlspecialchars_decode($siteinfo['mask_phone_extra']));?>" readonly />
					<?=form_error('mask_phone_extra'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-lg-3">
		<label class="form-labelblock" for="phone_city">
			Телефон (городской):
		</label>
	</div>
	<div class="col-xl-9 col-lg-9">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="phone_city" id="phone_city" value="<?=set_value('phone_city', $siteinfo['phone_city']);?>" />
					<?=form_error('phone_city'); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<input type="text" class="form-input" name="mask_phone_city" value="<?=set_value('mask_phone_city', htmlspecialchars_decode($siteinfo['mask_phone_city']));?>" readonly />
					<?=form_error('mask_phone_city'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?=$this->admincreator
	->set_name('address')
	->set_type('textarea')
	->set_label('Адрес')
	->set_value($siteinfo['address'])
	->create(); ?>

<?=$this->admincreator
	->set_name('map')
	->set_type('textarea')
	->set_label('Код карты')
	->set_params(['class' => 'form-input form-input-code'])
	->set_value(htmlspecialchars_decode($siteinfo['map']))
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Логотип компании</div>

<?=$this->admincreator
	->set_name('image')
	->set_type('file')
	->set_label('Изображение')
	->file_origin($siteinfo['image'], PATH_UPLOADS.'/'.$folder)
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Обратная связь</div>

<?=$this->admincreator
	->set_name('email_recipient')
	->set_type('textarea')
	->set_label('E-mail получателя')
	->set_value($siteinfo['email_recipient'])
	->label_info('Введите каждый новый e-mail с новой строки')
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('email_sender')
	->set_label('E-mail отправителя')
	->set_value($siteinfo['email_sender'])
	->set_required()
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Заглушка</div>

<?=$this->admincreator
	->set_name('enable')
	->set_type('checkbox')
	->set_label('Включить сайт')
	->set_value($siteinfo['enable'] == 1)
	->create(); ?>

<?=$this->admincreator
	->set_name('cap_title')
	->set_label('Заголовок для заглушки')
	->set_value($siteinfo['cap_title'])
	->create(); ?>

<?=$this->admincreator
	->set_name('cap_description')
	->set_type('textarea')
	->set_label('Описание для заглушки')
	->set_value($siteinfo['cap_description'])
	->create(); ?>
	
<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_save();?>
    <?=btn_save_exit();?>
    <?=btn_link_back($this->page);?>
</div>

<?=form_close();?>
