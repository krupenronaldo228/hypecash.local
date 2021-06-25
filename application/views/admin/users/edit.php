<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('access')
	->set_label('Роль')
	->set_type('select')
	->set_options($access)
	->set_value($item['access'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('login')
	->set_label('Логин')
	->set_value($item['login'])
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('name')
	->set_label('Ф.И.О.')
	->set_value($item['name'])
	->set_required()
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Контактные данные</div>

<?=$this->admincreator
	->set_name('email')
	->set_label('E-mail')
	->set_value($item['email'])
	->set_required()
	->input_info('Укажите действующий E-mail, на случай утери пароля')
	->create(); ?>

<?=$this->admincreator
	->set_name('phone')
	->set_label('Телефон')
	->set_value($item['phone'])
	->create(); ?>
	
<hr class="mt30 mb30" />

<div class="btns-list">
    <?=btn_save();?>
    <?=btn_save_exit();?>
    <?=btn_link_back($this->page);?>
</div>

<?=form_close();?>