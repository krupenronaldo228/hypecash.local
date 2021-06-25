<div class="cabinet-top">
	<?=$this->breadcrumbs->create_links();?>
	<div class="cabinet-title">
		<h1 class="title"><?=$pageinfo['title'];?></h1>
		<? if($pageinfo['brief']) { ?><div class="brief"><?=$pageinfo['brief'];?></div><? } ?>
	</div>
</div>

<ul class="cabinet-profile-blocks">
	<li>
		<div class="cabinet-subtitle">
			<div class="title"><?=fa5s('user-edit fa-fw mr5');?> Личные данные</div>
			<div class="brief">Здесь Вы можете изменить персональную информацию о себе</div>
		</div>
		<?=form_open('', ['class' => 'login-form']);?>
			<ul class="inputs">
				<li>
					<div class="form-caption">Логин <span class="required">*</span></div>
					<input type="text" name="login" class="form-input" value="<?=set_value('login', $userinfo['login']);?>" />
					<?=form_error('login')?>
				</li>
				<li>
					<div class="form-caption">Ф.И.О <span class="required">*</span></div>
					<input type="text" name="name" class="form-input" value="<?=set_value('name', $userinfo['name']);?>" />
					<?=form_error('name')?>
				</li>
				<li>
					<div class="form-caption">E-mail <span class="required">*</span></div>
					<input type="text" name="email" class="form-input" value="<?=set_value('email', $userinfo['email']);?>" />
					<?=form_error('email')?>
				</li>
				<li>
					<div class="form-caption">Телефон <span class="required">*</span></div>
					<input type="text" name="phone" class="form-input" value="<?=set_value('phone', $userinfo['phone']);?>" />
					<?=form_error('phone')?>
				</li>
			</ul>
			<div class="actions">
				<button class="btn"><?=fa5s('check mr5');?> Сохранить данные</button>
				<input type="hidden" name="action" value="profile" />
			</div>
		<?=form_close();?>
	</li>
	<li>
		<div class="cabinet-subtitle">
			<div class="title"><?=fa5s('user-shield fa-fw mr5');?> Пароль</div>
			<div class="brief">Здесь Вы можете изменить личный пароль от кабинета</div>
		</div>
		<?=form_open('', ['class' => 'login-form']);?>
			<ul class="inputs">
				<li>
					<div class="form-caption">Старый пароль <span class="required">*</span></div>
					<input type="password" name="old_password" class="form-input" value="<?=set_value('old_password');?>" />
					<?=form_error('old_password')?>
				</li>
				<li>
					<div class="form-caption">Новый пароль <span class="required">*</span></div>
					<input type="password" name="password" class="form-input" value="<?=set_value('password');?>" />
					<?=form_error('password')?>
				</li>
				<li>
					<div class="form-caption">Подтверждение пароля <span class="required">*</span></div>
					<input type="password" name="confirm_password" class="form-input" value="<?=set_value('confirm_password');?>" />
					<?=form_error('confirm_password')?>
				</li>
			</ul>
			<div class="actions">
				<button class="btn"><?=fa5s('check mr5');?> Сохранить пароль</button>
				<input type="hidden" name="action" value="password" />
			</div>
		<?=form_close();?>
	</li>
	<li>
		<div class="cabinet-subtitle">
			<div class="title"><?=fa5r('id-card fa-fw mr5');?> Фото профиля</div>
			<div class="brief">Рекомендуемый разрешение фото <?=$size['x'].'x'.$size['y'];?>px, размер файла не более 2Mb</div>
		</div>
		<?=form_open_multipart('', ['class' => 'login-form']);?>
			<div class="cabinet-profile-photo">
				<?=check_img('assets/uploads/users/thumb/'.$userinfo['img'], array(), 'user.png');?>
			</div>
			<div class="form-group">
				<input type="file" name="img" data-toggle="formfile" />
			</div>
			<div class="actions">
				<button class="btn"><?=fa5s('check mr5');?> Сохранить фото</button>
				<input type="hidden" name="action" value="photo" />
			</div>
		<?=form_close();?>
	</li>
</ul>

<? if(strip_tags($pageinfo['text']) != '') { ?>
<div class="cabinet-bottom">
	<div class="text-editor">
		<?=$pageinfo['text'];?>
	</div>
</div>
<? } ?>

<script>
	$('[name="phone"]').inputmask('+375 (99) 9999999');
</script>