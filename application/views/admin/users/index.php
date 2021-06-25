<? if(empty($items)) { ?>

	<?=action_result('info', 'У вас не создано еще ни одного пользователя. Вы можете '.anchor('admin/'.$this->page.'/create', 'создать пользователя'));?>

<? } else { ?>
	
	<table class="table table-hover entries-table">
		<thead>
			<tr>
				<th>Роль</th>
				<th>Пользователь</th>
				<th>Контакты</th>
				<th>Дата</th>
				<th>Действия</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($items as $item) { ?>
			<tr data-entries="item">
				<? $a = $access[$item['access']];?>
				<td class="entries-table-mobile w150">
					<span class="label label-small label-<?=$a['label'];?>"><?=$a['title'];?></span>
				</td>
				<td class="entries-table-mobile">
					<div class="entries-title"><?=fa5r('user-circle mr5'.ICON_SUFFIX);?> <span data-entries="title"><?=$item['login'];?></span></div>
					<div><?=fa5r('address-card mr5'.ICON_SUFFIX);?> <?=$item['name'];?></div>
				</td>
				<td class="entries-table-mobile">
					<div><?=$item['phone'] ? fa5s('phone mr5'.ICON_SUFFIX).' '.$item['phone'] : null;?></div>
					<div><?=$item['email'] ? fa5r('envelope mr5'.ICON_SUFFIX).' '.$item['email'] : null;?></div>
				</td>
				<td class="entries-td-hide-sm" nowrap>
					<?=entries_date($item['add_date']);?>
				</td>
				<td class="entries-td-actions w150">
					<?=btn_icon_view($this->page.'/view/'.$item['id']);?>
					<?=btn_icon_edit($this->page.'/edit/'.$item['id']);?>
					<? if($item['id'] != $userid) { ?>
						<?=btn_icon_delete($this->page.'/delete/'.$item['id']);?>
					<? } else { ?>
						<?=anchor('admin/'.$this->page.'/password', fa5s('lock'), ['class' => 'btn btn-sm btn-warning btn-icon', 'title' => 'Изменить свой пароль', 'data-toggle' => 'tooltip']);?>
					<? } ?>
				</td>
			</tr>
		<? } ?>
		</tbody>
	</table>
	
	<?=$this->pagination->create_links(); ?>
	
	<div class="form-actions mt20">
		<?=btn_link_create($this->page.'/create', 'Добавить пользователя');?>
	</div>

<? } ?>
