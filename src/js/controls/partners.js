var PROJECT = PROJECT || {};

PROJECT.PARTNERS = (function () {
	return {
		init: function (el,data) {
			var btn = el.querySelectorAll('.js-select-country');
			this.countries = el.querySelectorAll('.js-country');

			for(var i = 0; i < btn.length; i++){
				this.countryClick(btn[i]);
			}
		},

		countryClick: function(el){
			var view = this;

			el.addEventListener('click', function(e){
				e.preventDefault();
				var rel = e.currentTarget.rel;
				var targetOffset = document.querySelector('[data-country="'+rel+'"]').getBoundingClientRect();

				// scroll it!
				PROJECT.UTILS.scrollToY(targetOffset.top + document.body.scrollTop, 1500, 'easeInOutQuint');
			});
		}
	}
})();