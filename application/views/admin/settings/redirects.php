<div class="entries-sort <?=!empty($_GET) ? 'open' : null;?>">
	<a href="javascript:void(0)" class="entries-sort-title">
		Поиск по ссылкам
		<span class="toggle"><?=fa5s('angle-down');?></span>
	</a>
	<form action="<?=base_url('admin/'.$this->page.'/redirects')?>" method="GET" class="entries-sort-content">
		<div class="entries-sort-row row">
			<div class="col-sm-12">
				<input type="text" name="search" class="form-input" placeholder="Поиск по url" value="<?=$search; ?>"/>
			</div>
		</div>
		<ul class="entries-sort-actions">
			<li><button class="btn btn-info"><?=fa5s('search mr5');?> Поиск по записям</button></li>
			<? if(!empty($_GET)) { ?>
				<li><span class="form-label color-gray">Найдено записей: <strong><?=$count;?></strong></span></li>
				<li class="h6 semibold"><?=fa5s('times color-error mr5');?> <?=anchor('admin/'.$this->page.'/redirects', 'сбросить фильтр', ['class' => 'color-error']);?></li>
			<? } ?>
		</ul>
	</form>
</div>

<hr class="mb15" />

<? if (empty($items)) { ?>

	<? if(empty($_GET)) { ?>
		<?= action_result('info', 'У вас не создано еще ни одной записи.'); ?>
	<? } else { ?>
		<?= action_result('info', 'Поиск не дал результатов. ' . anchor('admin/' . $this->page.'/redirects', 'Сбросить фильтр.')); ?>
	<? } ?>

<? } else { ?>

<table class="table table-hover entries-table">
	<thead>
		<tr>
			<th>Исходный URL</th>
			<th></th>
			<th>Конечный URL</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($items as $item) { ?>
		<tr data-entries="item">
			<td class="entries-table-mobile">
				<?=str_replace($search, '<span style="background: yellow; font-weight: 700;">'.$search.'</span>', $item['url_from']);?>
			</td>
			<td class="entries-td-hide-sm w50 text-center" nowrap>
				<?=fa5s('arrow-right color-gray-lite');?>
			</td>
			<td class="entries-table-mobile">
				<?=str_replace($search, '<span style="background: yellow; font-weight: 700;">'.$search.'</span>', $item['url_to']);?>
			</td>
			<td class="entries-td-actions w125">
				<div class="none" data-entries="title"><?=$item['url_from'];?></div>
				<?=btn_icon_edit($this->page.'/redirects_edit/'.$item['id']);?>
				<?=btn_icon_delete($this->page.'/redirects_delete/'.$item['id']);?>
			</td>
		</tr>
	<? } ?>
	</tbody>
</table>

<?=$this->pagination->create_links(); ?>

<? } ?>

<div class="form-actions mt20">
	<?=btn_link_create($this->page.'/redirects_create')?>
	<?=anchor('admin/'.$this->page.'/redirect_editor', fa5s('pen mr5').' Быстрое редактирование', ['class' => 'btn btn-warning']);?>
	<?=btn_link_back($this->page);?>
</div>
