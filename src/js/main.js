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

			$('.js-prev').on('click', function(e) {
				e.preventDefault();
				console.log('yo!');
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