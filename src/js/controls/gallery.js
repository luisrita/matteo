var PROJECT = PROJECT || {};

PROJECT.GALLERY = (function () {
	return {
		init: function (el,data) {
			var images = el.querySelector('.gbox');
			
			$(el).find('.gbox').gallerybox({
				closeText: 'X'
			});
		}

	}
})();