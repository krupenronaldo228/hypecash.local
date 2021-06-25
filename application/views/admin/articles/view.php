<div data-entries="item">
	<div class="entries-view">
		<div class="entries-view-left">
			<div class="entries-view-img">
				<?=check_img(PATH_UPLOADS.'/'.$folder.'/thumb/'.$item['img']);?>
			</div>
		</div>
		<div class="entries-view-right">
			<h4 class="mb15" data-entries="title"><?=$item['title'];?></h4>
			<?=iconlist([
				['text' => anchor($this->page.'/'.$item['alias'], '', ['target' => '_blank']), 'icon' => fa5s('external-link-alt fa-fw')],
				['text' => $item['brief'] != '' ? nl2br($item['brief']) : EMPTY_TEXT, 'icon' => fa5r('comment-dots fa-fw')],
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
		<?=$item['text'] != '' ? $item['text'] : EMPTY_TEXT;?>
	</div>

	<hr class="mt30 mb30" />

	<h3 class="mb20">SEO:</h3>

	<?=iconlist([
		['text' => $item['meta_title'] != '' ? $item['meta_title'] : EMPTY_TEXT, 'icon' => fa5s('bullhorn fa-fw')],
		['text' => $item['meta_description'] != '' ? nl2br($item['meta_description']) : EMPTY_TEXT, 'icon' => fa5s('tags')],
		['text' => $item['img_alt'] != '' ? $item['img_alt'] : EMPTY_TEXT, 'icon' => fa5r('image')],
	]);?>
	
	<hr class="mt30 mb30" />

	<div class="btns-list">
		<?=btn_link_edit($this->page.'/edit/'.$item['id'])?>
		<?=btn_link_delete($this->page.'/delete/'.$item['id'])?>
		<?=btn_link_back($this->page)?>
	</div>
</div>