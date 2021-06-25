const product = 'data-product',
	add2cart = 'data-cart-add',
	rowid = 'data-product-rowid',
	cartActionAdd = 'cart_add',
	cartActionUpdate = 'cart_update',
	cartActionRemove = 'cart_remove';


// COUNTER

$(document)

	.on('click', '[data-counter-direction]', function(event) {
		event.preventDefault();
		
		let el = $(this),
			step = parseInt(el.attr('data-counter-direction')),
			counter = el.closest('[data-toggle="counter"]'),
			input = counter.find('[data-counter-input]'),
			val = parseInt(input.val()),
			value = val + step;
		
		if(value < 1)
			value = 1;
		
		input.val(value);
		
		let r = el.closest('[' + rowid + ']');
		if(r.length)
		{
			updateCart(r.attr(rowid), value);
		}
		
		return false;
		
	})
	.on('input', '[data-counter-input]', function () {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	})
	.on('change', '[data-counter-input]', function () {
		
		let input = $(this),
			val = input.val();
		
		if(val === '' || parseInt(val) < 1)
			input.val(1);
		
		let r = input.closest('[' + rowid + ']');
		if(r.length)
		{
			updateCart(r.attr(rowid), val);
		}
	});


// ADD TO CART

$(document).on('click', '[' + add2cart + ']', function(event){
	
	event.preventDefault();
	
	let el = $(this),
		item = el.closest('[' + product + ']'),
		id = item.attr(product),
		counter = item.find('[name="qty"]'),
		qty = 1;
	
	if(counter.length)
		qty = parseInt(counter.val());
	
	addCart(id, qty);
	
	return false;
});


// REMOVE FROM CART

$(document).on('click', '[data-cart-remove]', function(event){
	
	event.preventDefault();
	
	let id = $(this).closest('[' + rowid + ']').attr(rowid);
	
	removeCart(id);
	
	return false;
});



// FUNCTIONS

const cartHeader = '[data-cart-header]',
	cartPrice = '[data-cart-price]',
	cartTotal = '[data-cart-total]',
	cartCount = '[data-cart-count]',
	cartDelivery = '[data-cart-delivery]',
	cartDiscount = '[data-cart-discount]';

function addCart(id, qty)
{
	let data = new FormData();
	
	data.append('csrf_test_name', csrf_test_name);
	data.append('product', id);
	data.append('qty', qty);
	
	$.ajax({
		type: "POST",
		url: base_url + 'ajax/' + cartActionAdd,
		data: data,
		cache: false,
		async: false,
		processData: false,
		contentType: false,
		error: function () {
			modal_error('Ошибка запроса!', 'Обновите страницу или свяжитесь с администратором');
			return false;
		},
		success: function (response) {
			if (response.error) {
				modal_error(response.errorTitle, response.errorText);
				return false;
			}
			
			$(cartHeader).removeClass('empty');
			$(cartCount).text(response.total_items);
			$(cartPrice).text(response.html_price);
			
			let current_product = $('[' + product + '="' + response.id + '"]'),
				btn = current_product.find('[data-cart-add="button"]'),
				link = current_product.find('[data-cart-add="link"]');
			
			btn.addClass('btn-brown');
			btn.find('span').text(response.html_cart_btn);
			$(cartHeader).removeClass('empty');
			
			link.addClass('current')
			
		},
	});
}

function updateCart(product_rowid, qty)
{
	
	let data = new FormData();
	
	data.append('csrf_test_name', csrf_test_name);
	data.append('product', product_rowid);
	data.append('qty', qty);
	
	$.ajax({
		type: "POST",
		url: base_url + 'ajax/' + cartActionUpdate,
		data: data,
		cache: false,
		async: false,
		processData: false,
		contentType: false,
		error: function () {
			modal_error('Ошибка запроса!', 'Обновите страницу или свяжитесь с администратором');
			return false;
		},
		success: function (response) {
			if (response.error) {
				modal_error(response.errorTitle, response.errorText);
				return false;
			}
			
			updateInTotal(response);
			
		},
	});
	
}

function removeCart(product_rowid)
{
	
	let data = new FormData();
	
	data.append('csrf_test_name', csrf_test_name);
	data.append('product', product_rowid);
	
	$.ajax({
		type: "POST",
		url: base_url + 'ajax/' + cartActionRemove,
		data: data,
		cache: false,
		async: false,
		processData: false,
		contentType: false,
		error: function () {
			modal_error('Ошибка запроса!', 'Обновите страницу или свяжитесь с администратором');
			return false;
		},
		success: function (response) {
			if (response.error) {
				modal_error(response.errorTitle, response.errorText);
				return false;
			}
			
			updateInTotal(response);
			
		},
	});
	
}

function updateInTotal(data)
{
	// update totals
	
	$(cartCount).text(data.total_items);
	$(cartPrice).text(data.html_price);
	$(cartTotal).text(data.html_total);
	
	
	// update template
	
	if(data.total_items === 0)
	{
		$(cartHeader).addClass('empty')
	} else {
		$(cartHeader).removeClass('empty');
	}
	
	
	
	// update product
	
	if(data.action === 'update')
	{
		$('[' + rowid + '="' + data.rowid + '"] [data-cart-subtotal]').text(data.html_product_total);
	}
	else if(data.action === 'remove')
	{
		$('[' + rowid + '="' + data.rowid + '"]').remove();
	}

	if(!$('[' + rowid +']').length){
		$('.cart-container').html('<div class="note note-info">Ваша корзина пуста. <a href="http://sumki.loc/catalog">Перейти в каталог</a>, чтобы выбрать товары.</div>')
	}
}