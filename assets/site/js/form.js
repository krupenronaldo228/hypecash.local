$(document)

	// FEEDBACK MODAL
	.on('click', '[data-feedback]', function(){

		$('#popupFeedbackTask').val($(this).attr('data-feedback'));

	})

	// SUBMIT FORM
	.on('submit', '[data-toggle="ajaxForm"]', function(event){

		event.preventDefault();

		let form = $(this),
			validation = formValidation(form);

		if(validation === true)
		{
			let action = form.attr('action'),
				data = form.serialize(),
				thanks = $(form).is('[data-thanks]') ? $(form).attr('data-thanks') : '#popupThanks';

			$.ajax({
				type  : "POST",
				url   : action,
				data  : data,
				cache : false,
				async : false,
				error : function () {
					alert('Ошибка запроса');
					return false;
				},
				success : function(data) {
					if(!!!data.error && data.error != false)
					{
						alert('Ошибка запроса');
						return false;
					}

					if (data.error) {
						alert (data.error);
						return false;
					}

					$('[data-modal="close"]').trigger('click');
					modal_show(thanks);

					form.find('.form-input').val('');

				},
			});
		}

		return false;
	})

	// SOME VALIDATION
	.on('change', '[data-rules="required"]', function(){

		$(this).removeClass('input-error');

	})

	.on('change', '[data-input="email"]', function(){

		let pattern = /^([a-z0-9_.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

		if(pattern.test($(this).val()))
		{
			$(this).removeClass('input-error');
		}

	})

	.on('change keyup input click', '[data-input="num"]', function(){

		if (this.value.match(/[^0-9]/g))
		{
			this.value = this.value.replace(/[^0-9]/g, '');
		}

	})

	.on('change keyup input click', '[data-input="text"]', function(){

		if (this.value.match(/[^a-zA-Zа-яА-ЯёЁ .]/g))
		{
			this.value = this.value.replace(/[^a-zA-Zа-яА-ЯёЁ .]/g, '');
		}

	});


function formValidation(form)
{
	let validation = true;
	
	form.find('[data-rules="required"]').each(function(){

		let i = $(this),
			v = $.trim(i.val());

		i.val(v);

		if(i.val() === "")
		{
			i.addClass('input-error');
			validation = false;
		}
	});
	
	form.find('[data-input="email"]').each(function(){

		let i = $(this),
			v = $.trim(i.val()),
			p = /^([a-z0-9_.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

		if(i.val() !== "" && !p.test(i.val())){
			i.addClass('input-error');
			validation = false;
		}

	});
	
	return validation;
}