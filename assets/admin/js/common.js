$(function () {
	
	// SELECT
	
	$('select.form-select').styler();

	
	// TOOLTIPS
	
	$('[data-toggle="tooltip"]').tooltip();

});


/* CHECKBOX
------------------------------------------------------------------------ */

$(function () {

	$('[data-toggle="checker"]').each(function(){

		let el = $(this),
			c = 'checker-' + el.attr('type');

		el.wrap('<div class="checker ' + c + '"></div>');
		el.after('<div class="checker-view"></div>');

	});

	$('[data-toggle="toggler"]').each(function(){

		let el = $(this),
			c = 'toggler-' + el.attr('type');

		el.wrap('<div class="toggler ' + c + '"></div>');
		el.after('<div class="toggler-view"></div>');

	});

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



/* ACCORDEON
------------------------------------------------------------------------ */

const accordeon = 'data-toggle="accordeon"',
	accordeonItem = 'data-accordeon="item"',
	accordeonLink = 'data-accordeon="link"',
	accordeonContent = 'data-accordeon="content"';

$(document).on('click', '[' + accordeonLink + ']', function(event){

	event.preventDefault();

	let el = $(this),
		p = el.closest('[' + accordeon + ']'),
		i = el.closest('[' + accordeonItem + ']'),
		c = i.find('[' + accordeonContent + ']');

	if(!i.hasClass('current'))
	{
		if(p.is('[data-accordeon-collapse]'))
		{
			p.find('[' + accordeonItem + ']').removeClass('current');
			p.find('[' + accordeonContent + ']').slideUp(500);
		}

		i.addClass('current');
		c.slideDown(500);

	} else {

		i.removeClass('current');
		c.slideUp(500);

	}

	return false;
});

