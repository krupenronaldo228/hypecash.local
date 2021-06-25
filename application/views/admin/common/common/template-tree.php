<table class="table table-hover entries-table">
	<thead>
		<tr>
			<th></th>
			<th>Заголовок</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($items as $item) { ?>
		<?=catalog_tr($item);?>
	<? } ?>
	</tbody>
</table>



<? function catalog_tr($item, $level = 1) { ?>

	<tr class="entries-tree-item <?=!empty($item['childs']) ? 'not_empty' : null; ?>" data-entrie-parent="<?=$item['parent'];?>" data-entrie-id="<?=$item['id'];?>" style="<?=$item['parent'] != 0 ? 'display: none;' : null;?>" data-toggle="entries">
		<td class="entries-tree-toggles">
		<? if(!empty($item['childs'])) { ?>
			<div class="entries-tree-toggle color-warning">
				<span class="entries-tree-toggle-close"><?=fa5s('folder fa-fw');?></span>
				<span class="entries-tree-toggle-open"><?=fa5s('folder-open fa-fw');?></span>
				<span class="entries-tree-toggle-counter"><?=count($item['childs']);?></span>
			</div>
		<? } else { ?>
			<?=fa5r('file color-gray-lite fa-fw');?>
		<? } ?>
		</td>
		<td>
			<div style="padding-left: <?=$level * 15 - 15;?>px;">
				<div class="entries-title" data-entries="title"><?=$item['title'];?></div>
				<div class="entries-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nulla ante, molestie et mattis quis, accumsan sit amet magna. Etiam eleifend iaculis viverra.</div>
			</div>
		</td>
		<td class="entries-td-actions w150">
			<?=btn_icon_view($item['id']);?>
			<?=btn_icon_edit($item['id']);?>
			<?=btn_icon_delete($item['id']);?>
		</td>
	</tr>
	<? if(isset($item['childs'])) { ?>
		<? foreach($item['childs'] as $child) { ?>
			<?=catalog_tr($child, $level+1);?>
		<? } ?>
	<? } ?>
	
<? } ?>