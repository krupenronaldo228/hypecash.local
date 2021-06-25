<div class="popup" id="popupFeedback">
	<a href="javascript:void(0)" class="popup-close" data-modal="close"><?=fa5s('times');?></a>
	<div class="popup-top">
		<div class="title">Заказать звонок</div>
		<div class="brief">Оставьте заявку и наши специалисты свяжутся с Вами в ближайшее время</div>
	</div>
	<?=form_open('contacts/ajaxFeedback', ['class' => 'popup-form', 'data-toggle' => 'ajaxForm']);?>
	<ul class="inputs">
		<li>
			<input type="text" name="name" class="form-input" placeholder="Ваше имя" />
		</li>
		<li>
			<input type="tel" name="phone" class="form-input" placeholder="Ваш телефон *" data-rules="required" />
		</li>
	</ul>
	<div class="actions">
		<button class="btn btn-xl">Отправить</button>
		<input type="hidden" name="title" id="popupFeedbackTask" value="" />
	</div>
	<?=form_close();?>
</div>

<div class="popup" id="popupThanks">
	<a href="javascript:void(0)" class="popup-close" data-modal="close"><?=fa5s('times');?></a>
	<div class="popup-top">
		<div class="title">Спасибо за заявку</div>
		<div class="brief">Мы свяжемся с Вами в ближайшее рабочее время</div>
	</div>
</div>