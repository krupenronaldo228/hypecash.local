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
							<div class="form-caption">Ваш логин, номер телефона или email <span class="required">*</span></div>
							<input type="text" name="login" class="form-input" value="<?=set_value('login');?>" />
							<?=form_error('login');?>
						</li>
					</ul>
					<div class="actions">
						<button class="btn">Восстановить пароль <?=fa5s('arrow-right ml5');?></button>
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
						<a href="<?=base_url('register');?>">
							<?=fa5s('user-plus fa-fw mr5');?>
							<span>Создать новый аккаунт</span>
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
