jQuery(function($) {
	//menu
	$('body').on('click','.mobileMenu',function(){
		$('#page').toggleClass('mobileOpen');
		$('.menu .content').toggle('mobileOpen');
		$('.menuContainer').toggleClass('active');
		$('.menuContainer .menu').toggleClass('show');

		$(this).toggleClass('open');
	});
});