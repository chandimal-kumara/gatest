import 'flickity/dist/flickity.pkgd.js';
import Flickity from 'flickity';

export default {
  init() {
    // JavaScript to be fired on the home page
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS

    // Check if a specific id is in view and fire the CountUp Function
    var counter = 0;
    var observer = new IntersectionObserver(function(entries) {
      if(entries[0].isIntersecting === true)
        if (counter == 0) {
          setTimeout(function(){
            counter++;
            for (let i = 1; i < 4; i++) {
              document.querySelector('#final-'+ i).classList.remove('d-none');
              document.querySelector('#initial-'+ i).classList.add('d-none');
            }
            countUp();
          }, 500);
        }
    }, { threshold: [1] });

    observer.observe(document.querySelector('#home-company-statistics'));

    logoSectionGridSlider();
    logoSectionSlider();
    caseStudiesSlider();
  },
};

$(window).on('resize', function () {
  $('.home-logo-section .section-inner-wrp .logo-grid, .home-logo-section .section-inner-wrp .logo-slider, .home-case-studies-section .section-inner-wrp .case-studies-wrp .mobile-content').flickity('resize');
});

$(window).on('load', function () {
  $('.home-logo-section .section-inner-wrp .logo-grid, .home-logo-section .section-inner-wrp .logo-slider, .home-case-studies-section .section-inner-wrp .case-studies-wrp .mobile-content').flickity('resize');
});

function countUp() {
  $('.count').each(function () {
    $(this)
      .prop('Counter', 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 2000,
          easing: 'swing',
          step: function (now) {
            now = Number(Math.ceil(now)).toLocaleString('en');
            $(this).text(now);
          },
        }
      );
    }
  );
}

function logoSectionGridSlider() {
  $('.home-logo-section .section-inner-wrp .logo-grid').flickity({
    pageDots: true,
    prevNextButtons: false,
    wrapAround: true,
    adaptiveHeight: true,
    watchCSS: true,
  });
}

function logoSectionSlider() {
  if ($('.home-logo-section .section-inner-wrp .logo-slider').children().length > 6) {
    // Play with this value to change the speed
    let tickerSpeed = 1;

    let flickity = null;
    let isPaused = false;
    const slideshowEl = document.querySelector('.home-logo-section .section-inner-wrp .logo-slider');

    const update = () => {
      if (isPaused) return;
      if (flickity.slides) {
        flickity.x = (flickity.x - tickerSpeed) % flickity.slideableWidth;
        flickity.selectedIndex = flickity.dragEndRestingSelect();
        flickity.updateSelectedSlide();
        flickity.settle(flickity.x);
      }
      window.requestAnimationFrame(update);
    };

    const pause = () => {
      isPaused = true;
    };

    const play = () => {
      if (isPaused) {
        isPaused = false;
        window.requestAnimationFrame(update);
      }
    };

    flickity = new Flickity(slideshowEl, {
      autoPlay: false,
      prevNextButtons: false,
      pageDots: false,
      draggable: true,
      wrapAround: true,
      selectedAttraction: 0.015,
      friction: 0.25,
    });

    flickity.x = 0;

    slideshowEl.addEventListener('mouseenter', pause, false);
    slideshowEl.addEventListener('focusin', pause, false);
    slideshowEl.addEventListener('mouseleave', play, false);
    slideshowEl.addEventListener('focusout', play, false);

    flickity.on('dragStart', () => {
      isPaused = true;
    });

    update();
  }
}

function caseStudiesSlider() {
  $('.home-case-studies-section .section-inner-wrp .case-studies-wrp .mobile-content').flickity({
    pageDots: true,
    prevNextButtons: false,
    wrapAround: true,
    adaptiveHeight: true,
    watchCSS: true,
  });
}