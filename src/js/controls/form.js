var PROJECT = PROJECT || {};

PROJECT.FORM = (function () {
	return {
		init: function (el,data) {
			var btn = el.querySelector('.btn');
			var form = el.querySelector('form');

			btn.addEventListener('click', function(e){
				e.preventDefault();
				form.submit();
			});
		}

	}
})();