<div class="entries-view">
	<div class="entries-view-left">
		<div class="entries-view-img">
			<?=check_img(PATH_UPLOADS.'/settings/'.$siteinfo['image']);?>
		</div>
	</div>
	<div class="entries-view-right">
		<h2 class="bold mb5"><?=$siteinfo['title'];?></h2>
		<div class="h4 color-gray"><?=$siteinfo['description'];?></div>
	</div>
</div>

<hr class="mt30 mb30" />

<h3 class="mb20">Информация:</h3>

<?=iconlist([
	['text' => $siteinfo['owner'] != '' ? $siteinfo['owner'] : EMPTY_TEXT, 'icon' => fa5s('user-tie'.ICON_SUFFIX)],
	['text' => $siteinfo['details'] != '' ? nl2br($siteinfo['details']) : EMPTY_TEXT, 'icon' => fa5r('file-alt'.ICON_SUFFIX)],
	['text' => $siteinfo['copyright'] != '' ? nl2br($siteinfo['copyright']) : EMPTY_TEXT, 'icon' => fa5r('copyright'.ICON_SUFFIX)],
]);?>

<hr class="mt30 mb30" />

<h3 class="mb20">Контакты:</h3>

<?=iconlist([
	['text' => $siteinfo['email'] != '' ? $siteinfo['email'] : EMPTY_TEXT, 'icon' => fa5s('envelope'.ICON_SUFFIX)],
	['text' => $siteinfo['phone'] != '' ? mask($siteinfo['phone'], $siteinfo['mask_phone']) : EMPTY_TEXT, 'icon' => fa5s('phone-alt'.ICON_SUFFIX)],
	['text' => $siteinfo['phone_extra'] != '' ? mask($siteinfo['phone_extra'], $siteinfo['mask_phone_extra']) : EMPTY_TEXT, 'icon' => fa5s('phone-alt'.ICON_SUFFIX)],
	['text' => $siteinfo['phone_city'] != '' ? mask($siteinfo['phone_city'], $siteinfo['mask_phone_city']) : EMPTY_TEXT, 'icon' => fa5s('phone-rotary'.ICON_SUFFIX)],
	['text' => $siteinfo['address'] != '' ? nl2br($siteinfo['address']) : EMPTY_TEXT, 'icon' => fa5s('map-marker-alt'.ICON_SUFFIX)],
]);?>

<hr class="mt30 mb30" />

<h3 class="mb20">Заглушка:</h3>

<?=iconlist([
	[
		'text' => $siteinfo['enable'] == 1 ? 'Сайт доступен всем' : 'Доступ к сайту ограничен',
		'icon' => $siteinfo['enable'] == 1 ? fa5r('eye fa-fw color-success') : fa5s('eye-slash fa-fw text-error'),
	],
	['text' => $siteinfo['cap_title'] != '' ? $siteinfo['cap_title'] : 'Сайт временно закрыт', 'icon' => fa5s('bullhorn'.ICON_SUFFIX)],
	['text' => $siteinfo['cap_description'] != '' ? nl2br($siteinfo['cap_description']) : 'Приносим свои извинения и гарантируем в скором времени наладить работу', 'icon' => fa5s('align-left'.ICON_SUFFIX)],
]);?>

<hr class="mt30 mb30" />

<div class="btns-list">
	<?=anchor('admin/'.$this->page.'/edit', fa5s('pen mr5').' Изменить настройки', ['class' => 'btn btn-success']);?>
	<?=anchor('admin', fa5s('home mr5').' Вернуться на главную', ['class' => 'btn']);?>
</div>

<hr class="mt30 mb30" />

<h3 class="mb20">Продвинутое:</h3>

<div class="btns-list">
	<?=anchor('admin/'.$this->page.'/cache', fa5s('sync mr5').' Обновить кэш', ['class' => 'btn btn-warning mr5']);?>
	<?=anchor('/home/sitemap', fa5s('sitemap mr5').' Сгенерировать sitemap.xml', ['class' => 'btn btn-success mr5', 'target' => '_blank']);?>
	<?=anchor('/sitemap.xml', fa5r('file-alt mr5').' Открыть sitemap.xml', ['class' => 'btn btn-info mr5', 'target' => '_blank']);?>
	<?=anchor('admin/'.$this->page.'/redirects', fa5s('random mr5').' Настроить редиректы', ['class' => 'btn btn-error mr5']);?>
</div>

<div class="btns-list" style="display: inline-block; border: 3px solid rgba(255, 0, 0, 0.4); padding: 20px;">
	<div class="mb15 h6 bold color-error"><?=fa5s('exclamation-triangle mr5');?> Некорректное заполнение этих файлов может привести к поломке сайта!</div>
	<?=anchor('admin/'.$this->page.'/robots', fa5s('pen mr5').' Редактировать robots.txt', ['class' => 'btn btn-warning mr5']);?>
	<?=anchor('admin/'.$this->page.'/htaccess', fa5s('pen mr5').' Редактировать .htaccess', ['class' => 'btn btn-warning mr5']);?>
</div>
