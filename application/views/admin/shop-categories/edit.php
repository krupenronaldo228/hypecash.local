<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
    ->set_name('title')
    ->set_label('Заголовок')
    ->set_value($item['title'])
    ->set_required()
    ->create(); ?>

<?=$this->admincreator
    ->set_name('code')
    ->set_label('Код товара')
    /*->set_required()*/
    ->create(); ?>

<?=$this->admincreator
    ->set_name('brief')
    ->set_label('Описание')
    ->set_value($item['brief'])
    ->set_required()
    ->create(); ?>

<?=$this->admincreator
    ->set_name('text')
    ->set_label('Текст')
    ->set_value($item['text'])
    ->set_required()
    ->create(); ?>


<?=$this->admincreator
	->set_name('name')
	->set_label('Название')
	->set_value($item['name'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
    ->set_name('alias')
    ->set_label('Ссылка (ЧПУ)')
    ->set_value($item['alias'])
    ->set_required()
    ->input_info('<a href="javascript:void(0)" class="h6" data-toggle="translate_title">перевести заголовок</a>')
    ->create(); ?>

<?=$this->admincreator
	->set_name('img')
	->set_type('file')
	->set_label('Изображение')
	->label_info('Рекомендуемый размер не меньше '.$size['x'].'x'.$size['y'])
	->file_origin($item['img'], PATH_UPLOADS.'/'.$folder.'/thumb')
	->file_delete('admin/'.$this->page.'/ajaxImageDelete/'.$item['id'])
	->create(); ?>

<!--<hr class="mt30 mb30" />

<div class="h3 bold mb20">SEO</div>

<hr class="mt30 mb30" />-->

<div class="h3 bold mb20">Настройки</div>

<div class="row form-group">
    <div class="col-xl-3 col-lg-3">
        <label class="form-labelblock" for="admin_input_id_parent">
            Родительская категория <span class="required">*</span>
        </label>
    </div>
    <div class="col-xl-9 col-lg-9">
        <select class="form-select" name="id_parent" id="admin_input_id_parent">
            <option value="0" <?=set_select('id_parent', 0, $item['id_parent'] == 0);?>>Корень</option>
            <? foreach($parents as $parent) { ?>
                <?=catalog_option($parent, $item['id'], $item['id_parent']);?>
            <? } ?>
        </select>
        <?=form_error('id_parent'); ?>
    </div>
</div>

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
    ->set_name('num')
    ->set_label('Приоритет')
    ->set_params(['type' => 'number', 'min' => 1])
    ->set_value($item['num'])
    ->create(); ?>

<?=$this->admincreator
	->set_name('visibility')
	->set_type('checkbox')
	->set_label('Отображать на сайте')
	->set_value($item['visibility'] == 1)
	->create(); ?>

<?=$this->admincreator
    ->set_name('home')
    ->set_type('checkbox')
    ->set_label('Отображать на главной')
    ->set_value($item['home'] == 1)
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

<? function catalog_option($item, $current, $parent, $disabled = false, $level = 1) {

    $_count_nbs = ($level - 1) * 3;
    $levelUp = $level + 1;

    if($item['id'] == $current)
        $disabled = true;

    $option = '<option value="'.$item['id'].'" '.set_select('id_parent', $item['id'], $item['id'] == $parent).' '.($disabled ? 'disabled' : null).'>';
    $option .= nbs($_count_nbs).' '.$item['name'];
    $option .= '</option>';

    echo $option;

    if(isset($item['items'])) {
        foreach($item['items'] as $childs) {
            catalog_option($childs, $current, $parent, $disabled, $levelUp);
        }
    }
} ?>
