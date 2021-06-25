<? if(empty($items)) { ?>

<?=action_result('info', 'У вас не создано еще ни одной записи. Вы можете '.anchor('admin/'.uri(2).'/create', 'создать запись.'));?>

<? } else { ?>

<table class="table table-hover entries-table">
	<thead>
		<tr>
			<td class="entries-new"><?=is_read(0);?></td>
			<th>Изображение</th>
			<th>Имя</th>
			<th>Контакты</th>
			<th>Опубликовано</th>
			<th>Дата</th>
			<th></th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($items as $item) { ?>
		<tr data-entries="item">
			<td class="entries-new"><?=is_read($item['is_read']);?></td>
			<td class="entries-td-img entries-td-hide-xs">
				<div class="img"><?=check_img(PATH_UPLOADS.'/'.$folder.'/thumb/'.$item['img'], ['class' => 'block w75'], 'user.png');?></div>
			</td>
			<td class="entries-table-mobile">
				<div class="entries-title" data-entries="title"><?=$item['name'];?></div>
				<div class="entries-brief"><?=character_limiter($item['text'], 200);?></div>
			</td>
			<td class="entries-table-mobile">
				<div><?=$item['phone'] ? fa5s('phone mr5'.ICON_SUFFIX).' '.$item['phone'] : null;?></div>
				<div><?=$item['email'] ? fa5r('envelope mr5'.ICON_SUFFIX).' '.$item['email'] : null;?></div>
				<?=entries_link($item['link']);?>
			</td>
			<td class="entries-td-hide-sm" nowrap>
				<?=entries_date($item['pub_date']);?>
			</td>
			<td class="entries-td-hide-sm" nowrap>
				<?=entries_date($item['add_date']);?>
			</td>
			<td class="entries-td-icons entries-td-hide-xs text-right">
				<?=visibility($item['visibility']);?>
			</td>
			<td class="entries-td-actions w150">
				<?=btn_icon_view($this->page.'/view/'.$item['id']);?>
				<?=btn_icon_edit($this->page.'/edit/'.$item['id']);?>
				<?=btn_icon_delete($this->page.'/delete/'.$item['id']);?>
			</td>
		</tr>
	<? } ?>
	</tbody>
</table>

<?=$this->pagination->create_links(); ?>

<div class="form-actions mt20">
	<?=btn_link_create($this->page.'/create')?>
</div>

<? } ?>