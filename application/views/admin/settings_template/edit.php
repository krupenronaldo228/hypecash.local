<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<div class="h3 bold mb20">Встраивание кода</div>

<?=$this->admincreator
	->set_name('code_header')
	->set_type('textarea')
	->set_params(['rows' => 5, 'class' => 'form-input form-input-code'])
	->set_label('Код в шапке')
	->set_value($siteinfo['code_header'])
	->create(); ?>

<?=$this->admincreator
	->set_name('code_footer')
	->set_type('textarea')
	->set_params(['rows' => 5, 'class' => 'form-input form-input-code'])
	->set_label('Код в футере')
	->set_value($siteinfo['code_footer'])
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Favicon</div>

<?=$this->admincreator
	->set_name('favicon')
	->set_type('file')
	->set_label('Изображение')
	->set_params(['accept' => 'image/x-png'])
	->label_info('Файл 192x192px в формате PNG')
	->file_origin('favicon.png', PATH_SITE.'/img/favicon')
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Open Graph</div>

<?=$this->admincreator
	->set_name('og_image')
	->set_type('file')
	->set_label('Изображение')
	->set_params(['accept' => 'image/jpeg'])
	->label_info('Файл 1200x630px в формате JPG')
	->file_origin('og_image.jpg', PATH_SITE.'/img')
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Общее</div>

<div class="row">
	<div class="col-xl-3 col-lg-3">
		<label class="form-labelblock" for="admin_template_color">
			Цвет вкладки (HEX-code)
			<div class="form-info color-gray">Для мобильных устройств</div>
		</label>
	</div>
	<div class="col-xl-9 col-lg-9">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<? $color = set_value('template_color', $siteinfo['template_color']);?>
					<div class="input-group-color" id="colorSquare" style="width: 40px; height: 40px; background: #<?=$color;?>; border: 1px solid #d8dbe6;"></div>
				</div>
				<input type="text" class="form-input uppercase" name="template_color" id="admin_template_color" value="<?=$color;?>" />
			</div>
			<?=form_error('template_color'); ?>
		</div>
	</div>
</div>

<?=$this->admincreator
	->set_name('template_alt')
	->set_label('Alt изображений')
	->set_value($siteinfo['template_alt'])
	->create(); ?>
	
<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_save();?>
    <?=btn_save_exit();?>
    <?=btn_link_back($this->page);?>
</div>

<?=form_close();?>

<script>
	$(document).on('change', '[name="template_color"]', function () {

		let c = $(this).val();

		$('#colorSquare').css({'background': '#' + c});

	});
</script>
