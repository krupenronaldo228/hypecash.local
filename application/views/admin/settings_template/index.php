<h3 class="mb20">Информация:</h3>

<?=iconlist([
	['text' => $siteinfo['template_color'] != '' ? $siteinfo['template_color'] : EMPTY_TEXT, 'icon' => fa5s('palette'.ICON_SUFFIX)],
	['text' => $siteinfo['template_alt'] != '' ? $siteinfo['template_alt'] : EMPTY_TEXT, 'icon' => fa5s('image'.ICON_SUFFIX)],
]);?>

<hr class="mt30 mb30" />

<h3 class="mb20">Коды:</h3>

<ul class="entries-view-info">
	<li>
		<div class="item">
			<div class="icon"><?=fa5s('code');?></div>
			<div class="text">
				<div class="mb5">Код в шапке:</div>
				<? if($siteinfo['code_header'] == '') { ?>
					<?=EMPTY_TEXT;?>
				<? } else { ?>
					<textarea rows="5" class="form-input form-input-code" readonly><?=$siteinfo['code_header'];?></textarea>
				<? } ?>
			</div>
		</div>
	</li>
	<li>
		<div class="item">
			<div class="icon"><?=fa5s('code');?></div>
			<div class="text">
				<div class="mb5">Код в футере:</div>
				<? if($siteinfo['code_footer'] == '') { ?>
					<?=EMPTY_TEXT;?>
				<? } else { ?>
					<textarea rows="5" class="form-input form-input-code" readonly><?=$siteinfo['code_footer'];?></textarea>
				<? } ?>
			</div>
		</div>
	</li>
</ul>


<hr class="mt30 mb30" />

<div class="btns-list">
	<?=anchor('admin/'.$this->page.'/edit', fa5s('pen mr5').' Изменить настройки', ['class' => 'btn btn-success']);?>
	<?=anchor('admin', fa5s('home mr5').' Вернуться на главную', ['class' => 'btn']);?>
</div>
