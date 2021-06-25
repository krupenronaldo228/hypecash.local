<div class="page-content">
	<div class="container">
		<div class="page-top">
			<?=$this->breadcrumbs->create_links();?>
			<h1 class="page-title"><?=$pageinfo['title'];?></h1>
			<? if($pageinfo['brief']) { ?><div class="page-brief"><?=$pageinfo['brief'];?></div><? } ?>
		</div>
		
		<? $this->load->view('site/common/warning');?>
		
		<div class="login-content">
			<div class="login-content-left">
				<?=form_open('', ['class' => 'login-form']);?>
					<ul class="inputs">
						<li>
							<div class="form-caption">Логин <span class="required">*</span></div>
							<input type="text" name="login" class="form-input" value="<?=set_value('login');?>" />
							<?=form_error('login');?>
						</li>
						<li>
							<div class="form-caption">Ф.И.О. <span class="required">*</span></div>
							<input type="text" name="name" class="form-input" value="<?=set_value('name');?>" />
							<?=form_error('name');?>
						</li>
						<li>
							<div class="form-caption">Email <span class="required">*</span></div>
							<input type="text" name="email" class="form-input" value="<?=set_value('email');?>" />
							<?=form_error('email');?>
						</li>
						<li>
							<div class="form-caption">Телефон <span class="required">*</span></div>
							<input type="text" name="phone" class="form-input" value="<?=set_value('phone');?>" />
							<?=form_error('phone');?>
						</li>
						<li>
							<div class="form-caption">Пароль <span class="required">*</span></div>
							<input type="password" name="password" class="form-input" value="<?=set_value('password');?>" />
							<?=form_error('password');?>
							<div class="form-info">Пароль должен содержать не менее 6 символов</div>
						</li>
						<li>
							<div class="form-caption">Подтверждение пароля <span class="required">*</span></div>
							<input type="password" name="password_confirm" class="form-input" value="<?=set_value('password_confirm');?>" />
							<?=form_error('password_confirm');?>
						</li>
					</ul>
					<div class="actions">
						<button class="btn">Зарегистрироваться <?=fa5s('arrow-right ml5');?></button>
						<input type="hidden" name="url" value="<?=set_value('url');?>" />
					</div>
				<?=form_close();?>
			</div>
			<div class="login-content-right">
				<ul class="login-links">
					<li>
						<a href="<?=base_url('login');?>">
							<?=fa5s('user-check fa-fw mr5');?>
							<span>Войти в кабинет</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url('login/password');?>">
							<?=fa5s('question-circle fa-fw mr5');?>
							<span>Забыли пароль?</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<? if(strip_tags($pageinfo['text']) != '') { ?>
		<div class="page-text">
			<div class="text-editor">
				<?=$pageinfo['text'];?>
			</div>
		</div>
		<? } ?>

	</div>
</div>
