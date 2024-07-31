	//<![CDATA[
	var scrollTimer = null;
	$(window).scroll(function() {
	   var viewportHeight = $(this).height(),
		   scrollbarHeight = viewportHeight / $(document).height() * viewportHeight,
		   progress = $(this).scrollTop() / ($(document).height() - viewportHeight),
		   distance = progress * (viewportHeight - scrollbarHeight) + scrollbarHeight / 2 - $('#scroll').height() / 2;
		$('#scroll')
			.css('top', distance)
			.text(' (' + Math.round(progress * 100) + '%)')
			.fadeIn(100);
		if (scrollTimer !== null) {
			clearTimeout(scrollTimer);
		}
		scrollTimer = setTimeout(function() {
			$('#scroll').fadeOut();
		}, 1500);
	});
	//]]>