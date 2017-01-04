var PROJECT = PROJECT || {};

PROJECT.READMORE = (function () {
	return {
		init: function (el,data) {
			var btn = el.querySelector('.js-read-more');
			var moreContent = el.querySelector('.more_content');

			btn.addEventListener('click', function(e){
				e.preventDefault();
				PROJECT.UTILS.addClass(btn.parentNode,'hidden');
				//PROJECT.UTILS.slideDown(moreContent);
				$('.post__content').addClass('opened');
			});
		}

	}
})();