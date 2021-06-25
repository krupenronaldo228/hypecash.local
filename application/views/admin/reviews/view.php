<div data-entries="item">
	<div class="entries-view">
		<div class="entries-view-left">
			<div class="entries-view-img">
				<?=check_img(PATH_UPLOADS.'/'.$folder.'/thumb/'.$item['img'], [], 'user.png');?>
			</div>
		</div>
		<div class="entries-view-right">
			<h4 class="mb15" data-entries="title"><?=$item['name'];?></h4>
			<?=iconlist([
				['text' => $item['phone'] != '' ? $item['phone'] : EMPTY_TEXT, 'icon' => fa5s('phone'.ICON_SUFFIX)],
				['text' => $item['email'] != '' ? $item['email'] : EMPTY_TEXT, 'icon' => fa5r('envelope'.ICON_SUFFIX)],
				['text' => $item['link'] != '' ? anchor($item['link'], $item['link'], ['target' => '_blank']) : EMPTY_TEXT, 'icon' => fa5s('external-link-alt'.ICON_SUFFIX)],
			]);?>
		</div>
	</div>

	<hr class="mt30 mb30" />

	<h3 class="mb20">Информация:</h3>
	
	<?=iconlist([
		iconlist_visibility($item['visibility']),
		['text' => date('d.m.Y H:i', strtotime($item['pub_date'])), 'icon' => fa5s('bullhorn fa-fw')],
		['text' => date('d.m.Y H:i', strtotime($item['add_date'])), 'icon' => fa5r('calendar-plus fa-fw')],
	]);?>

	<hr class="mt30 mb30" />

	<h3 class="mb20">Текст страницы:</h3>
	
	<div class="text-editor">
		<?=$item['text'] != '' ? nl2br($item['text']) : EMPTY_TEXT;?>
	</div>
	
	<hr class="mt30 mb30" />
	
	<div class="btns-list">
		<?=btn_link_edit($this->page.'/edit/'.$item['id'])?>
		<?=btn_link_delete($this->page.'/delete/'.$item['id'])?>
		<?=btn_link_back($this->page)?>
	</div>
</div>