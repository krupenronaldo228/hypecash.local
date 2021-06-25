<?=form_open_multipart('', ['class' => 'responsive-form', 'data-toggle' => 'entryform']);?>

<?=$this->admincreator
	->set_name('access')
	->set_label('Роль')
	->set_type('select')
	->set_options($access)
	->set_value(ACCESS_USER)
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('login')
	->set_label('Логин')
	->set_required()
	->create(); ?>

<?=$this->admincreator
	->set_name('name')
	->set_label('Ф.И.О.')
	->set_required()
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Контактные данные</div>

<?=$this->admincreator
	->set_name('email')
	->set_label('E-mail')
	->set_required()
	->input_info('Укажите действующий E-mail, на случай утери пароля')
	->create(); ?>

<?=$this->admincreator
	->set_name('phone')
	->set_label('Телефон')
	->create(); ?>

<hr class="mt30 mb30" />

<div class="h3 bold mb20">Пароль</div>

<?=$this->admincreator
	->set_name('password')
	->set_label('Пароль')
	->set_required()
	->input_info('<a href="javascript:void(0)" class="h6" id="genPass">Сгенерировать пароль</a>')
	->create(); ?>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=btn_add();?>
	<?=btn_link_back($this->page);?>
</div>
<?=form_close();?>

<script>
	$('#genPass').click(function(){
		var length = 10;
        var result = '';
        var symbols = new Array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M',1,2,3,4,5,6,7,8,9,0);
        for (var i = 0; i < length; i++){
			result += symbols[Math.floor(Math.random() * symbols.length)];
        }
		$('[name="password"]').val(result);
	})
</script>