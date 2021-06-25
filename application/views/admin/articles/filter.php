<div class="entries-sort <?=!empty($_GET) ? 'open' : null;?>">
	<a href="javascript:void(0)" class="entries-sort-title">
		Поиск по записям
		<span class="toggle"><?=fa5s('angle-down');?></span>
	</a>
	<form action="<?=base_url('admin/'.$this->page)?>" method="GET" class="entries-sort-content">
		<div class="entries-sort-row row">
			<div class="col-md-12 col-lg-6">
				<input type="search" name="search" class="form-input" placeholder="Поиск" value="<?=$this->input->get('search');?>" />
			</div>

			<div class="col-md-6 col-lg-3">
				<? $visibility = array(
					'all' => 'Видимость',
					'yes' => 'Отображается',
					'no' => 'Скрыта',
				); ?>
				<select class="form-select" name="visibility">
					<? $get_visibility = $this->input->get('visibility'); if(empty($get_visibility)) $get_visibility = 'all';?>
					<? foreach ($visibility as $value => $label) { ?>
						<option value="<?=$value;?>" <?=$get_visibility == $value ? 'selected' : null; ?>><?=$label;?></option>
					<? } ?>
				</select>
			</div>

			<div class="col-md-6 col-lg-3">
				<? $sorts = [
					'pub_date DESC' => 'Дата публикации &darr;',
					'pub_date ASC' => 'Дата публикации &uarr;',
					'add_date DESC' => 'Дата добавления &darr;',
					'add_date ASC' => 'Дата добавления &uarr;',
					'title ASC' => 'Заголовок &uarr;',
					'title DESC' => 'Заголовок &darr;',
				]; ?>
				<select class="form-select" name="sort">
					<? foreach ($sorts as $value => $label) { ?>
						<option value="<?= $value; ?>" <?=$sort == $value ? 'selected' : null; ?>><?= $label; ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<ul class="entries-sort-actions">
			<li><button class="btn btn-info"><?=fa5s('search mr5');?> Поиск по записям</button></li>
			<? if(!empty($_GET)) { ?>
				<li><span class="form-label color-gray">Найдено записей: <strong><?=$count;?></strong></span></li>
				<li class="h6 semibold"><?=fa5s('times color-error mr5');?> <?=anchor('admin/'.$this->page, 'сбросить фильтр', ['class' => 'color-error']);?></li>
			<? } ?>
		</ul>
	</form>
</div>