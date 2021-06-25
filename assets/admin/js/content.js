/* DELETE MODAL
------------------------------------------------------------------------ */

$(document).on('click', '[data-entries="delete"]',function(event){

	event.preventDefault();

	let el = $(this);

	$('#deleteEntryForm').attr('action', el.attr('href'));
	$('#deleteEntryTitle').text('"' + el.closest('[data-entries="item"]').find('[data-entries="title"]').text() + '"');

	$('#deleteEntryModal').modal('show');

	return false;
});



/* ENTRIES TREE
------------------------------------------------------------------------ */

$(document).on('click', '[data-entries="title"]',function(){

	let el = $(this),
		p = el.closest('[data-entrie-id]'),
		i = p.attr('data-entrie-id'),
		l = $('[data-entrie-parent="' + i + '"]');

	if(p.hasClass('entries-tree-item-open'))
	{
		p.removeClass('entries-tree-item-open');
		entries_tree_hide(i);

	} else {

		p.addClass('entries-tree-item-open');
		l.show();
	}
});

function entries_tree_hide(id)
{
	let l = $('[data-entrie-parent="' + id + '"]');

	if(l.length)
	{
		l.each(function(){

			let el = $(this),
				i = el.attr('data-entrie-id');

			el.hide();
			el.removeClass('entries-tree-item-open');

			entries_tree_hide(i);
		});
	}
}



/* AJAX IMAGE DELETE
------------------------------------------------------------------------ */

$(document).on('click', '[data-formfile-remove]', function(event){

	event.preventDefault();

	if(!confirm('Удалить изображение?')) return;

	let el = $(this),
		action = el.attr('href'),
		t = el.attr('data-formfile-remove');

	$.ajax({
		type: "POST",
		url: action,
		data: {
			csrf_test_name : csrf_test_name,
			type: t,
			delete_img : 'delete'
		},
		error: function () {
			alert('Ошибка запроса');
		},
		success: function(data) {
			if(data.error)
			{
				alert(data.error);
				return false;
			}

			el.closest('[data-formfile="preview"]').remove();
		}
	});

	return false;
});



/* ENTRIES SORT FORM
------------------------------------------------------------------------ */

$(document).on('click', '.entries-sort-title',function(){

	$(this).closest('.entries-sort').toggleClass('open');

});



/* SAVE AND EXIT
------------------------------------------------------------------------ */

$(document).on('click', '[data-entryform="close"]', function(){

	let el = $(this).closest('[data-toggle="entryform"]');

	el.attr('action', el.attr('action') + '/close');

});



/* ALIAS AND META TITLE
------------------------------------------------------------------------ */

$(document)

	.on('click', '[data-toggle="translate_title"]', function(){

		let alias = $('[name="alias"]');

		if($(this).closest('form').find('[name="name"]').length)
		{
			alias.val(translit($('[name="name"]').val(), true));
		} else {
			alias.val(translit($('[name="title"]').val(), true));
		}

	})
	.on('click', '[data-toggle="copy_title"]', function(){

		let meta = $('[name="meta_title"]');

		meta.val($('[name="title"]').val());
		string_counter(meta);

	})
	.on('change', '[name="name"]', function(){

		let alias = $('[name="alias"]');

		if(alias.length && alias.val() === '')
		{
			alias.val(translit($(this).val(), true));
		}

	})
	.on('change', '[name="title"]', function(){

		let v = $(this).val(),
			meta = $('[name="meta_title"]'),
			alias = $('[name="alias"]')

		if($(this).closest('form').find('[name="name"]').length === 0 && alias.length && alias.val() === '')
		{
			alias.val(translit(v, true));
		}

		if(meta.length && meta.val() === '')
		{
			meta.val(v);
			string_counter(meta);
		}
	});

function translit(str, isLower)
{
	let space = '-',
		result = '',
		current_sim = '',
		translate = {
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',  'з': 'z', 'и': 'i', 'й': 'j',
			'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f',
			'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
			'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'E', 'Ж': 'ZH',  'З': 'Z', 'И': 'I', 'Й': 'J',
			'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F',
			'Х': 'H', 'Ц': 'C', 'Ч': 'CH', 'Ш': 'SH', 'Щ': 'SH', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'YU', 'Я': 'YA',
			' ': space, '_': space, '`': space, '~': space, '!': space, '@': space, '#': space, '$': space, '%': space,
			'^': space, '&': space, '*': space, '(': space, ')': space, '-': space, '\=': space, '+': space, '[': space,
			']': space, '\\': space, '|': space, '/': space, '.': space, ',': space, '{': space, '}': space, '\'': space,
			'"': space, ';': space, ':': space, '?': space, '<': space, '>': space, '№': space, '»': space, '«':	space
		};

	if(isLower) str = str.toLowerCase();

	for(let i = 0; i < str.length; i++)
	{
		if(translate[str[i]] !== undefined)
		{
			if(current_sim !== translate[str[i]] || current_sim !== space)
			{
				result += translate[str[i]];
				current_sim = translate[str[i]];
			}
		}
		else {
			result += str[i];
			current_sim = str[i];
		}
	}

	result = result.replace(/^-/, '');
	result = result.replace(/[-]{2,}/gim, '-').replace(/[^-0-9a-zA-Z]/gim,'');

	return result;
}


/* STRING COUNTER
------------------------------------------------------------------------ */

$(function () {

	$('[data-toggle="strcount"]')
		.each(function () {

			let el = $(this),
				id = el.attr('name'),
				counter = $('[data-strcount="' + id + '"]'),
				total = el.attr('data-strcount-needle');

			counter.html('<span data-strcount-text="count">0</span> / <span data-strcount-text="total">' + total + '</span>');

			string_counter($(this));
		})
		.on('input', function () {

			string_counter($(this));

		});
});

function string_counter(el)
{
	let id = el.attr('name'),
		counter = $('[data-strcount="' + id + '"]'),
		counter_current = counter.find('[data-strcount-text="count"]'),
		current = parseInt(el.val().length),
		total = parseInt(el.attr('data-strcount-needle')),
		allow = parseInt(el.attr('data-strcount-allow'));

	counter_current.text(current);

	if(current === 0 || current > total) {

		counter.attr('class', 'form-counter color-error');

	} else if(current >= allow && current <= total) {

		counter.attr('class', 'form-counter color-success');

	} else {

		counter.attr('class', 'form-counter color-warning');

	}
}