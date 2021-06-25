<? if(empty($items)) { ?>

	<?=action_result('info', 'У вас не создано еще ни одной записи. Вы можете '.anchor('panel/'.$this->page.'/create', 'создать запись.'));?>

<? } else { ?>

	<table class="table table-hover entries-table">
		<thead>
			<tr>
				<th>#</th>
				<th></th>
				<th>Заголовок</th>
				<th>Ссылка</th>
				<th></th>
				<th>Действия</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($items as $item) { ?>
			<tr data-entries="item">
				<td class="w50 entries-td-hide-xs">
					<?=$item['num'];?>
				</td>
				<td class="w50 entries-td-hide-xs">
					<div class="entries-social">
						<i class="fa5 <?=$item['icon'];?>"></i>
					</div>
				</td>
				<td class="entries-table-mobile">
					<div class="entries-title" data-entries="title"><?=$item['title'];?></div>
				</td>
				<td class="entries-table-mobile">
					<?=entries_link($item['link']);?>
				</td>
				<td class="entries-td-icons entries-td-hide-xs text-right">
					<?=visibility($item['visibility']);?>
				</td>
				<td class="entries-td-actions w100">
					<?=btn_icon_edit($this->page.'/edit/'.$item['id']);?>
					<?=btn_icon_delete($this->page.'/delete/'.$item['id']);?>
				</td>
			</tr>
		<? } ?>
		</tbody>
	</table>

	<div class="form-actions mt20">
		<?=btn_link_create($this->page.'/create')?>
	</div>

<? } ?>
