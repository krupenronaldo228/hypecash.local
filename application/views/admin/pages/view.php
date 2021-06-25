<div data-entries="item">
	<h4 class="mb15" data-entries="title"><?=$item['title'];?></h4>
	<?=iconlist([
		['text' => anchor($item['alias'], '', ['target' => '_blank']), 'icon' => fa5s('external-link-alt'.ICON_SUFFIX)],
		['text' => $item['brief'] != '' ? nl2br($item['brief']) : EMPTY_TEXT, 'icon' => fa5r('file-alt'.ICON_SUFFIX)],
	]);?>

	<hr class="mt30 mb30" />

	<h3 class="mb20">Информация:</h3>
	
	<?=iconlist([
		iconlist_visibility($item['visibility']),
		['text' => date('d.m.Y H:i', strtotime($item['add_date'])), 'icon' => fa5r('calendar-plus'.ICON_SUFFIX)],
	]);?>

	<hr class="mt30 mb30" />

	<h3 class="mb20">Текст страницы:</h3>

	<div class="text-editor">
		<?=$item['text'] != '' ? $item['text'] : EMPTY_TEXT;?>
	</div>

	<hr class="mt30 mb30" />

	<h3 class="mb20">SEO:</h3>

	<?=iconlist([
		['text' => $item['meta_title'] != '' ? $item['meta_title'] : EMPTY_TEXT, 'icon' => fa5s('bullhorn'.ICON_SUFFIX)],
		['text' => $item['meta_description'] != '' ? nl2br($item['meta_description']) : EMPTY_TEXT, 'icon' => fa5s('tags'.ICON_SUFFIX)],
	]);?>
	
	<hr class="mt30 mb30" />
	
	<div class="btns-list">
		<?=btn_link_edit($this->page.'/edit/'.$item['id'])?>
		<?=btn_link_delete($this->page.'/delete/'.$item['id'])?>
		<?=btn_link_back($this->page)?>
	</div>
</div>