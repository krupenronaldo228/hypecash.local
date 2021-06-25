<? if(empty($items)) { ?>

<?=action_result('info', 'У вас не создано еще ни одной записи. Вы можете '.anchor('admin/'.uri(2).'/create', 'создать запись.'));?>

<? } else { ?>

<table class="table table-hover entries-table">
	<thead>
		<tr>
			<th></th>
			<th>Название</th>
			<th>Ссылка</th>
			<th></th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($items as $item) { ?>
		<?=items_tree($item, 1, $this->page);?>
	<? } ?>
	</tbody>
</table>

<div class="form-actions mt20">
	<?=btn_link_create($this->page.'/create')?>
</div>

<? } ?>

<? function items_tree($item, $level = 1, $page) { ?>
	
	<? $not_empty = !empty($item['childs']);?>
	
	<tr class="entries-tree-item <?=$not_empty ? 'not_empty' : null; ?>" data-entrie-parent="<?=$item['id_parent'];?>" data-entrie-id="<?=$item['id'];?>" style="<?=$item['id_parent'] != 0 ? 'display: none;' : null;?>" data-entries="item">
		<td class="entries-tree-toggles">
		<? if(!empty($item['childs'])) { ?>
			<div class="entries-tree-toggle color-warning">
				<span class="entries-tree-toggle-close"><?=fa5s('folder fa-fw');?></span>
				<span class="entries-tree-toggle-open"><?=fa5s('folder-open fa-fw');?></span>
				<span class="entries-tree-toggle-counter"><?=count($item['childs']);?></span>
			</div>
		<? } else { ?>
			<?=fa5s('link color-gray-lite fa-fw');?>
		<? } ?>
		</td>
		<td>
			<div style="padding-left: <?=$level * 15 - 15;?>px;">
				<div class="entries-title <?=$not_empty ? 'bold' : null; ?>" data-entries="title"><?=$item['title'];?></div>
			</div>
		</td>
		<td><?=entries_link($item['link']);?></td>
		<td class="entries-td-icons entries-td-hide-xs text-right">
			<? if($item['noindex']) { ?><span class="color-gray mr5" data-toggle="tooltip" data-title="Ссылка не индексируется"><?=fa5s('ban');?></span><? } ?>
			<?=visibility($item['visibility']);?>
		</td>
		<td class="entries-td-actions w100">
			<?=btn_icon_edit($page.'/edit/'.$item['id']);?>
			<?=btn_icon_delete($page.'/delete/'.$item['id']);?>
		</td>
	</tr>
	<? if(isset($item['childs'])) {
		foreach($item['childs'] as $child)
			echo items_tree($child, $level + 1, $page);
	} ?>
	
<? } ?>