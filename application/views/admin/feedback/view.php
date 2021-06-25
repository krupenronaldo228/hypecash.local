<div data-entries="item">
	<div class="row form-group">
		<div class="col-md-3 bold">Тема:</div>
		<div class="col-md-9" data-entries="title"><?=$item['title'];?></div>
	</div>
	<div class="row form-group">
		<div class="col-md-3 bold">Имя:</div>
		<div class="col-md-9"><?=$item['name'] ?? EMPTY_TEXT;?></div>
	</div>
	<div class="row form-group">
		<div class="col-md-3 bold">Телефон:</div>
		<div class="col-md-9"><?=$item['phone'] ?? EMPTY_TEXT;?></div>
	</div>
	<div class="row form-group">
		<div class="col-md-3 bold">E-mail:</div>
		<div class="col-md-9"><?=$item['email'] ?? EMPTY_TEXT;?></div>
	</div>
	<div class="row form-group">
		<div class="col-md-3 bold">Комментарий:</div>
		<div class="col-md-9"><?=$item['text'] ? nl2br($item['text']) : EMPTY_TEXT;?></div>
	</div>
	<div class="row form-group">
		<div class="col-md-3 bold">Дата:</div>
		<div class="col-md-9"><?=date('d.m.Y H:i', strtotime($item['add_date']));?></div>
	</div>
	
	<hr class="mt30 mb30" />
	
	<div class="btns-list">
		<?=btn_link_delete($this->page.'/delete/'.$item['id']);?>
		<?=btn_link_back($this->page)?>
	</div>
</div>