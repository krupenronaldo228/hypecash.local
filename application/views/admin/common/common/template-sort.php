<div class="entries-sort <?=!empty($_GET) ? 'open' : null;?>">
	<a href="javascript:void(0)" class="entries-sort-title">
		Filter form
		<span class="toggle"><?=fa5s('angle-down');?></span>
	</a>
	<form action="" method="GET" class="entries-sort-content">
		<div class="entries-sort-row row">
			<div class="col-sm-8">
				<input type="search" name="search" class="form-input" placeholder="Поиск" value="<?=$this->input->get('search');?>" />
			</div>
			<div class="col-sm-4">
				<? $sorts = [
					'date|DESC' => 'Дата &darr;',
					'date|ASC' => 'Дата &uarr;',
					'title|DESC' => 'Название &darr;',
					'title|ASC' => 'Название &uarr;',
				];?>
				<? $sort_get = $this->input->get('sort'); if(empty($sort_get)) $sort_get = 'date|DESC';?>
				<select name="sort" class="form-select">
				<? foreach($sorts as $sort => $label) { ?>
					<option value="<?=$sort;?>" <?=$sort == $sort_get ? 'selected' : null;?>><?=$label;?></option>
				<? } ?>
				</select>
			</div>
		</div>
		<ul class="entries-sort-actions">
			<li><button class="btn btn-info"><?=fa5s('search mr5');?> Поиск по записям</button></li>
			<li><span class="form-label color-gray">Найдено записей: <strong><?=$count;?></strong></span></li>
			<? if(!empty($_GET)) { ?><li class="h6 semibold"><?=fa5s('times color-error mr5');?> <?=anchor(current_url(), 'сбросить фильтр', ['class' => 'color-error']);?></li><? } ?>
		</ul>
	</form>
</div>