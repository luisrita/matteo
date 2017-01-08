var PROJECT = PROJECT || {};

PROJECT.MAIN = (function () {
	return {
		init: function () {
			var view = this;

			var elements = document.querySelectorAll('[data-control]');
			Array.prototype.forEach.call(elements, function(elem, i){
				var data = elem.dataset,
						control = data.control;

				if (!PROJECT[control]) {
					return;
				}

				if (typeof PROJECT[control] === 'function') {
					var obj = new PROJECT[control]();
					obj.init(elem, data);
				} else if(typeof PROJECT[control] === 'object') {
					PROJECT[control].init(elem, data);
				}
			});

			$('.js-btn').on('click', function(e) {
				e.preventDefault();
				var currentItem = $('.js-item.active'),
						index;
					
				$(currentItem).removeClass('active');

				if ( $(this).hasClass('js-prev') ) {

					if ( $(currentItem).prev().length !== 0 ) {
						$(currentItem).prev().addClass('active');
						index = $(currentItem).prev().index() + 1
					} else {
						$('.js-item').last().addClass('active');
						index = $('.js-item').last().index() + 1
					}

				} else {

					if ( $(currentItem).next('.js-item').length !== 0 ) {
						$(currentItem).next().addClass('active');
						index = $(currentItem).next().index() + 1
					} else {
						$('.js-item').first().addClass('active');
						index = $('.js-item').first().index() + 1
					}
					
				}

				$('.js-item-num').text(index);
			})
		}
	};
})();

function ready(fn) {
	if (document.readyState != 'loading'){
		console.log('start');
		PROJECT.MAIN.init();
	} else {
		document.addEventListener('DOMContentLoaded', fn);
	}
}

ready(PROJECT.MAIN.init);