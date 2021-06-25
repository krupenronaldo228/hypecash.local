<? if(empty($items)) { ?>

<?=action_result('info', 'У вас нет ни одного входящего сообщения.');?>

<? } else { ?>

<table class="table table-hover entries-table">
	<thead>
		<tr>
			<th class="entries-new"><?=is_read(0);?></th>
			<th>Тема</th>
			<th>ФИО</th>
			<th>Контакты</th>
			<th>Дата</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($items as $item) { ?>
		<tr data-entries="item">
			<td class="entries-new">
				<?=is_read($item['is_read']);?>
			</td>
			<td class="entries-table-mobile">
				<div class="entries-title" data-entries="title"><?=$item['title'];?></div>
			</td>
			<td class="entries-table-mobile">
				<?=$item['name'] ? fa5r('user-circle mr5'.ICON_SUFFIX).' '.$item['name'] : null;?>
			</td>
			<td class="entries-table-mobile">
				<div><?=$item['phone'] ? fa5s('phone mr5'.ICON_SUFFIX).' '.$item['phone'] : null;?></div>
				<div><?=$item['email'] ? fa5r('envelope mr5'.ICON_SUFFIX).' '.$item['email'] : null;?></div>
			</td>
			<td class="entries-td-hide-sm" nowrap>
				<?=entries_date($item['add_date']);?>
			</td>
			<td class="entries-td-actions w100">
				<?=btn_icon_view($this->page.'/view/'.$item['id']);?>
				<?=btn_icon_delete($this->page.'/delete/'.$item['id']);?>
			</td>
		</tr>
	<? } ?>
	</tbody>
</table>

<?=$this->pagination->create_links(); ?>

<? } ?>