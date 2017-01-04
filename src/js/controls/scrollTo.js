var PROJECT = PROJECT || {};

PROJECT.SCROLLTO = (function () {
	return {
		init: function (el,data) {
			var btn = el.querySelector('.js-scroll-to');
			var destination = document.querySelector('.js-scroll-destination');
			var targetOffset = destination.getBoundingClientRect();

			btn.addEventListener('click', function(e){
				e.preventDefault();
				PROJECT.UTILS.scrollToY(targetOffset.top + document.body.scrollTop, 1500, 'easeInOutQuint');
			});
		}
	}
})();