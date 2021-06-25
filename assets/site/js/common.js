/* MODAL
------------------------------------------------------------------------ */

$(document)
	.on('click', '[data-toggle="modal"]', function(event){
		event.preventDefault();
		modal_show($(this).attr('href'));
	})

	.on('click', '[data-modal="close"]', function(event){

		event.preventDefault();

		let c = $(this).closest('[data-modal-container]');

		c.hide();
		c.find('.popup').removeClass('show');

		$('body').removeClass('overflow');

	})

	.on('click', '[data-modal-container]', function(event){

		let t = $(event.target);

		if(t.is('[data-modal-container]'))
		{
			modal_hide(t.attr('data-modal-container'));
		}

	})

	.on('keydown',function(event){
		if (event.which === 27)
		{
			let p = $('.popup.show');

			if(p.length)
			{
				modal_hide('#' + p.attr('id'));
			}
		}
	});

function modal_show(id)
{
	if($('body > [data-modal-container="' + id + '"]').length == 0)
	{
		$('body').append('<div class="popup-container" data-modal="container" data-modal-container="' + id + '"></div>');
		$(id).appendTo('[data-modal-container="' + id + '"]');
	}

	$('body').addClass('overflow');

	$('[data-modal-container="' + id + '"]').fadeIn(100, function(){
		$('[data-modal-container="' + id + '"] .popup').addClass('show');
	});
}

function modal_hide(id)
{
	$(id).removeClass('show');
	$(id).closest('[data-modal-container]').hide();

	$('body').removeClass('overflow');
}


/* TABS
------------------------------------------------------------------------ */

const tabs = 'data-toggle="tabs"',
	tabsLink = 'data-tabs="link"',
	tabsContent = 'data-tabs="content"';

$(document).on('click', '[' + tabsLink + ']', function(event){

	event.preventDefault();

	let el = $(this),
		p = el.closest('[' + tabs + ']'),
		i = el.attr('href');

	if(!el.hasClass('current'))
	{
		p.find('[' + tabsLink + ']').removeClass('current');
		el.addClass('current');

		p.find('[' + tabsContent + ']').hide();
		$(i).fadeIn(500);
	}

	return false;
});



/* INPUT FILE
------------------------------------------------------------------------ */

const formFile = '[data-toggle="formfile"]',
	formFileItem = '[data-formfile="item"]',
	formFileInput = '[data-formfile="input"]',
	formFileBtn = '[data-formfile="btn"]',
	formFileClear = '[data-formfile="clear"]';

// WRAP INPUT FILE
$(function () {

	$(formFile).each(function(){

		let el = $(this),
			n = el.attr('name');

		el.wrap('<div class="form-file" data-formfile="item" data-formfile-name="' + n + '"></div>');
		el.after('<input type="text" class="form-input" data-formfile="input" readonly placeholder="Файл не выбран" />');
		el.after('<a href="javascript:void(0)" class="btn" data-formfile="btn"><i class="fa5 fas fa-search"></i><span>Обзор</span></a>');
		el.after('<a href="javascript:void(0)" class="form-file-clear form-file-clear-hidden" data-formfile="clear" title="очистить выбранный файл"><i class="fa5 fas fa-times"></i></a>');

	});

});

$(document)

	// CLICK ON BUTTON
	.on('click', formFileBtn, function (event) {

		event.preventDefault();
		$(this).closest(formFileItem).find(formFile).trigger('click');
		return false;
	})

	// CHANGE INPUT FILE
	.on('change', formFile, function () {

		let el = $(this),
			v = el.val().split("\\"),
			n = v[v.length-1],
			c = el.closest(formFileItem).find(formFileClear);

		el.closest(formFileItem).find(formFileInput).val(n);

		if(n === '')
			c.addClass('form-file-clear-hidden');
		else
			c.removeClass('form-file-clear-hidden');

	})

	// CLEAR BUTTON
	.on('click', formFileClear, function (event) {

		event.preventDefault();

		let el = $(this),
			item = el.closest(formFileItem);

		item.find(formFile).val('');
		item.find(formFileInput).val('');

		el.addClass('form-file-clear-hidden');

		return false;

	});