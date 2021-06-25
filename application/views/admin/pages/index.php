<? if(empty($items)) { ?>
	
	<?=action_result('info', 'У вас не создано еще ни одной записи. Вы можете '.anchor('admin/'.$this->page.'/create', 'создать запись.'));?>

<? } else { ?>
	
	<table class="table table-hover entries-table">
		<thead>
			<tr>
				<th>Заголовок</th>
				<th>Дата</th>
				<th></th>
				<th>Действия</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($items as $item) { ?>
			<tr data-entries="item">
				<td class="entries-table-mobile">
					<div class="entries-title" data-entries="title"><?=$item['title'];?></div>
					<div class="entries-brief"><?=$item['brief'];?></div>
				</td>
				<td class="entries-td-hide-sm" nowrap>
					<?=entries_date($item['add_date']);?>
				</td>
				<td class="entries-td-icons entries-td-hide-xs text-right">
					<?=seo_checker($item);?>
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