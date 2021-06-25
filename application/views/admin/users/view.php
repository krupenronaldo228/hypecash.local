<div data-entries="item">
	<div class="entries-view">
		<div class="entries-view-left">
			<div class="entries-view-img">
				<?=check_img(PATH_UPLOADS.'/'.$folder.'/thumb/'.$item['img'], null, 'user.png');?>
			</div>
		</div>
		<div class="entries-view-right">
			<h4 class="mb15" data-entries="title">
				<span data-entries="title"><?=$item['login'];?></span>
				<span class="regular">
					- <?=$item['name'];?>
					<? if($item['id'] == $userid) { ?>
						<span class="color-gray-lite h5 ml5">(мой профиль)</span>
					<? } ?>
				</span>
			</h4>
			<?=iconlist([
				['text' => $access['title'], 'icon' => fa5r('user-circle'.ICON_SUFFIX)],
				['text' => $item['email'] ?? EMPTY_TEXT, 'icon' => fa5r('envelope'.ICON_SUFFIX)],
				['text' => $item['phone'] ?? EMPTY_TEXT, 'icon' => fa5s('phone'.ICON_SUFFIX)],
			]);?>
		</div>
	</div>
	
	<hr class="mt30 mb30" />
	
	<div class="btns-list">
		<?=btn_link_edit($this->page.'/edit/'.$item['id'])?>
		<? if($item['id'] != $userid) { ?>
			<?=btn_link_delete($this->page.'/delete/'.$item['id'])?>
		<? } ?>
		<?=btn_link_back($this->page)?>
	</div>
</div>