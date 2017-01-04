var PROJECT = PROJECT || {};

PROJECT.UTILS = (function () {
	return {

		scrollToY: function(scrollTargetY, speed, easing) {

	    var scrollY = window.scrollY || document.documentElement.scrollTop,
	        scrollTargetY = scrollTargetY || 0,
	        speed = speed || 2000,
	        easing = easing || 'easeOutSine',
	        currentTime = 0;

	    // min time .1, max time .8 seconds
	    var time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

	    // easing equations from https://github.com/danro/easing-js/blob/master/easing.js
	    var easingEquations = {
        easeOutSine: function (pos) {
          return Math.sin(pos * (Math.PI / 2));
        },
        easeInOutSine: function (pos) {
          return (-0.5 * (Math.cos(Math.PI * pos) - 1));
        },
        easeInOutQuint: function (pos) {
          if ((pos /= 0.5) < 1) {
              return 0.5 * Math.pow(pos, 5);
          }
          return 0.5 * (Math.pow((pos - 2), 5) + 2);
        }
      };

	    // add animation loop
	    function tick() {
        currentTime += 1 / 60;

        var p = currentTime / time;
        var t = easingEquations[easing](p);

        if (p < 1) {
          requestAnimFrame(tick);
          window.scrollTo(0, scrollY + ((scrollTargetY - scrollY) * t));
        } else {
          window.scrollTo(0, scrollTargetY);
        }
	    }

	    // call it once to get started
	    tick();
		},

		addClass: function(el,className){
      if (el.classList){
        el.classList.add(className);
      } else {
        el.className += ' ' + className;
      }
    },

    removeClass: function(el,className){
      if (el.classList){
        el.classList.remove(className);
      } else {
        el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    },

    hasClass: function(el,c){
      return el.className.split(" ").indexOf(c) > -1;
    },

    slideDown: function(elem) {
      elem.style.maxHeight = '5000px';
      elem.style.opacity   = '1';
    },

    slideUp: function(elem) {
      elem.style.maxHeight = '0';
      this.slideOnce( 1, function () {
        elem.style.opacity = '0';
      });
    },

    slideOnce: function(seconds, callback) {
      var counter = 0;
      var time = window.setInterval( function () {
        counter++;
        if ( counter >= seconds ) {
          callback();
          window.clearInterval( time );
        }
      }, 400 );
    }
	}
})();

