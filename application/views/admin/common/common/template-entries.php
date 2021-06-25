<? $this->load->view('admin/common/common/template-sort'); ?>

<table class="table table-hover entries-table">
	<thead>
		<tr>
			<th>Изображение</th>
			<th>Заголовок</th>
			<th>Добавлено</th>
			<th></th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? for($i = 1; $i < 4; $i++) { ?>
		<tr data-toggle="entries">
			<td class="entries-td-img entries-td-hide-xs">
				<div class="img"><?=check_img('assets/uploads/files/test/'.$i.'.jpg');?></div>
			</td>
			<td class="entries-table-mobile">
				<div class="entries-title" data-entries="title">Entries title</div>
				<div class="entries-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nulla ante, molestie et mattis quis, accumsan sit amet magna. Etiam eleifend iaculis viverra.</div>
			</td>
			<td class="entries-td-hide-sm" nowrap><?=entries_date('25.07.2019 9:00');?></td>
			<td class="entries-td-hide-xs text-right"><?=visibility(1);?></td>
			<td class="entries-td-actions w175">
				<?=btn_icon_view($i);?>
				<?=btn_icon_edit($i);?>
				<?=btn_icon_delete($i);?>
				<div class="drophover">
					<a href="javascript:void(0)" class="btn btn-sm btn-icon drophover-btn"><?=fa5s('ellipsis-h');?></a>
					<div class="drophover-menu drophover-menu-xs drophover-menu-bottom-right">
						<ul class="drophover-list">
							<li>
								<a href="javascript:void(0)" class="drophover-list-item">
									<?=fa5r('eye fa-fw color-info');?> View
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="drophover-list-item">
									<?=fa5s('pencil-alt fa-fw color-info');?> Edit
								</a>
							</li>
							<li class="drophover-list-divider"></li>
							<li>
								<a href="javascript:void(0)" class="drophover-list-item">
									<?=fa5s('times fa-fw color-info');?> Remove
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>
	<? } ?>
	</tbody>
</table>

<?=$this->pagination->create_links();?>