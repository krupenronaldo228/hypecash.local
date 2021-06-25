<div class="page-content">
	<div class="container">
		<div class="page-top">
			<?=$this->breadcrumbs->create_links();?>
			<h1 class="page-title"><?=$pageinfo['title'];?></h1>
			<? if($pageinfo['brief']) { ?><div class="page-brief"><?=$pageinfo['brief'];?></div><? } ?>
		</div>
		
		<? if($siteinfo['map']) { ?>
		<div class="contacts-map">
			<?=htmlspecialchars_decode($siteinfo['map']);?>
		</div>
		<? } ?>
		
		<div class="contacts-content">
			<div class="contacts-content-left">
				<div class="contacts-title">Контакты</div>
				<ul class="contacts-info">
					<li>
						<div class="item">
							<?=fa5s('phone fa-fw');?>
							<ul class="phones">
								<li><a href="tel:+<?=$siteinfo['phone'];?>" class="phone"><?=mask($siteinfo['phone'], $siteinfo['mask_phone']);?></a></li>
								<? if($siteinfo['phone_extra'] != '') { ?>
								<li><a href="tel:+<?=$siteinfo['phone_extra'];?>" class="phone"><?=mask($siteinfo['phone_extra'], $siteinfo['mask_phone_extra']);?></a></li>
								<? } ?>
								<? if($siteinfo['phone_city'] != '') { ?>
								<li><a href="tel:+<?=$siteinfo['phone_city'];?>" class="phone"><?=mask($siteinfo['phone_city'], $siteinfo['mask_phone_city']);?></a></li>
								<? } ?>
							</ul>
						</div>
					</li>
					<li>
						<div class="item">
							<?=fa5s('envelope fa-fw');?>
							<a href="mailto:+<?=$siteinfo['email'];?>" class="email"><?=$siteinfo['email'];?></a>
						</div>
					</li>
					<? if($siteinfo['address'] != '') { ?>
					<li>
						<div class="item">
							<?=fa5s('map-marker-alt fa-fw');?>
							<?=nl2br($siteinfo['address']);?>
						</div>
					</li>
					<? } ?>
					<? if($siteinfo['owner'] != '' || $siteinfo['details'] != '') { ?>
					<li>
						<div class="item">
							<?=fa5s('file-alt fa-fw');?>
							<? if($siteinfo['owner'] != '') { ?><div class="bold"><?=$siteinfo['owner'];?></div><? } ?>
							<? if($siteinfo['details'] != '') { ?><?=nl2br($siteinfo['details']);?><? } ?>
						</div>
					</li>
					<? } ?>
				</ul>
			</div>
			<div class="contacts-content-right">
				<div class="contacts-title">Заказать звонок</div>
				<?=form_open('contacts/ajaxFeedback', ['class' => 'contacts-form', 'data-toggle' => 'ajaxForm']);?>
					<ul class="inputs">
						<li>
							<input type="text" name="name" class="form-input" placeholder="Ваше имя" />
						</li>
						<li>
							<input type="tel" name="phone" class="form-input" placeholder="Ваш телефон *" data-rules="required" />
						</li>
						<li>
							<input type="email" name="email" class="form-input" placeholder="Ваш email" />
						</li>
						<li>
							<textarea name="text" class="form-input" placeholder="Текст сообщения" rows="3"></textarea>
						</li>
					</ul>
					<div class="actions">
						<div class="text">
							Ваш данные не будут переданы третьим лицам.<br/>
							<a href="<?=base_url('about/confidence');?>">Политика конфиденциальности.</a>
						</div>
						<button class="btn btn-xl">Отправить</button>
						<input type="hidden" name="title" value="Обратная связь: контакты" />
					</div>
				<?=form_close();?>
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
