<? if(empty($items)) { ?>

<?=action_result('info', 'У вас не создано еще ни одной страницы. Страницы создаются в базе данных.');?>

<? } else { ?>
	
	<table class="table table-hover entries-table">
		<thead>
			<tr>
				<th>Название</th>
				<th>Заголовок</th>
				<th>Alias</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<? foreach($items as $item) { ?>
			<tr data-entries="item">
				<td class="entries-table-mobile">
					<div class="entries-title"><?=$item['name'];?></div>
				</td>
				<td class="entries-table-mobile">
					<?=$item['title'];?>
				</td>
				<td class="entries-td-hide-xs">
					<?=$item['alias'];?>
				</td>
				<td class="entries-td-actions w50">
					<?=btn_icon_edit($this->page.'/edit/'.$item['id']);?>
				</td>
			</tr>
		<? } ?>
		</tbody>
	</table>
	
	<?=$this->pagination->create_links(); ?>

<? } ?>