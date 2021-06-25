// PAGE CONTENT

function pageContent() {

	let pageContent = $('.page-content');

	if(pageContent.length)
	{
		let windowHeight = $(window).height(),
			sideNav = $('.sidenav').height(),
			height = sideNav > windowHeight ? sideNav - 15 : windowHeight - 45,
			pageContentHeight = height - $('.header').outerHeight() - $('.page-top').outerHeight();

		pageContent.css('min-height', pageContentHeight);
	}
	
}

$(window)
	.on('load', function(){
		pageContent()
	})
	.on('resize', function(){
		pageContent()
	});


// HEADER NAV

$(document)

	// NAVIGATION

	.on('click', '[data-toggle="nav"]', function(event){
	
		event.preventDefault();

		$('.container').toggleClass('open-sidenav');

		return false;

	})

	.on('click', function(event) {

		if ($(event.target).closest('.sidenav').length) return;

		$('.container').removeClass('open-sidenav');

		event.stopPropagation();
	})

	// USER BAR

	.on('click', '.header-userbar-info', function(event){
	
		event.preventDefault();

		$('.header-userbar-menu').toggleClass('open');

		return false;

	})

	.click(function(event) {
	
		if ($(event.target).closest('.header-userbar').length) return;

		$('.header-userbar-menu').removeClass('open');

		event.stopPropagation();
	});

