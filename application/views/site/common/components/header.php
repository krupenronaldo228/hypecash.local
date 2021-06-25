<header class="header">
	<div class="container">
		<div class="header-logo">
			<a href="<?=base_url();?>" class="logo-container">
				<?=img([
					'src' => PATH_UPLOADS.'/settings/'.$siteinfo['image'],
					'alt' => $siteinfo['template_alt'],
					'class' => 'logo'
				]);?>
				<div class="logo-description">
					<div class="logo-title"><?=$siteinfo['title'];?></div>
					<div class="logo-text"><?=$siteinfo['description'];?></div>
				</div>
			</a>
		</div>
		<div class="header-right">
			<div class="header-callback">
				<a href="" class="btn" data-toggle="modal" data-feedback="Заказать звонок: шапка">Заказать звонок</a>
			</div>
		</div>
	</div>
</header>
