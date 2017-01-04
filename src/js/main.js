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

			window.requestAnimFrame = (function(){
				return  window.requestAnimationFrame       ||
								window.webkitRequestAnimationFrame ||
								window.mozRequestAnimationFrame    ||
								function( callback ){
									window.setTimeout(callback, 1000 / 60);
								};
			})();
			
			function responsiveMenu() {
				$('.js-nav-menu').on('click', function(e) {
					e.preventDefault();
					$('.js-top-menu').addClass('active');
				});

				$('.js-close').on('click', function(e) {
					e.preventDefault();
					$('.js-top-menu').removeClass('active');
				});

				$('.js-mobile-search').on('click', function(e) {
					e.preventDefault();
					$(this).toggleClass('active');
					$('.js-search-field').toggleClass('active');
				});

				$('.wrap').prev('a').on('click', function(e) {
					e.preventDefault();
					$(this).next().toggleClass('active');
				});
			}

			if( $(window).width() < 1366 ) {
				responsiveMenu();
			}

			$(window).on('resize', function() {
				if( $(window).width() < 1366 ) {
					responsiveMenu();
				} else {
					$('.js-nav-menu').unbind('click');
					$('.js-close').unbind('click');
					$('.js-mobile-search').unbind('click');
					$('.wrap').prev('a').unbind('click');
				}
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