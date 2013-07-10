$(window).load(function() {
	var $container = $('#portfolio-container');
	// initialize isotope
	$container.isotope({
		itemSelector : '.item',
		layoutMode : 'masonry'
	});

	// filter items when filter link is clicked
	$('#filter a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
	});

	$('#tag a').click(function(){
		var selector = $(this).attr('data-tag');
		$container.isotope({ filter: selector });
		return false;
	});
});