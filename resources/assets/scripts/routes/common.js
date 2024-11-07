import 'flickity/dist/flickity.pkgd.js';
import Flickity from 'flickity';
import 'viewerjs/dist/viewer.min.js';
import 'jquery-viewer/dist/jquery-viewer.min.js';
import 'select2/dist/js/select2.min.js';

// sticky header variable
var shrinkHeader = 5;

Flickity.prototype._createResizeClass = function() {
  this.element.classList.add('flickity-resize');
};

Flickity.createMethods.push('_createResizeClass');

var resize = Flickity.prototype.resize;
Flickity.prototype.resize = function() {
  this.element.classList.remove('flickity-resize');
  resize.call( this );
  this.element.classList.add('flickity-resize');
};

export default {
  init() {
    // JavaScript to be fired on all pages

    Flickity.defaults.dragThreshold = 3;
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    const slideshowElements = document.querySelectorAll('.logo-section .logo-slider');
    slideshowElements.forEach(element => {
      logoSectionSlider(element);
    });

    deleteCookie('PREF');
    headerScripts();
    logoSectionGridSlider();
    formScripts();
    cardSectionGridSlider();
    cardSectionSlider();
    cardSectionGridSliderNew();
    cardSectionSliderNew();
    gallerySectionSlider();
    jqueryViewer('.gallery-images-viewer-v2');
    jqueryViewer('.gallery-images-viewer-v1');
    fullWidthVideoPlayerFile();
    videoPopupPlayerFile();
    delayHomeBannerVideoFile();
    editorContentAdditions();
    loadMore();
    cookieConsent();
    testimonialGridSlider();
    testimonialSlider();
  },
};

$(window).on('resize', function () {
  $('.cards-section.v1 .cards-wrp, .cards-section.v2 .cards-wrp, .cards-section.v3 .cards-wrp, .gallery-section.v1 .gallery-wrapper, .cards-section-new.slider .cards-wrp, .cards-section-new.grid .cards-wrp .testimonials-section .testimonials-row'
  ).flickity('resize');

  // set header height to sticky overlay
  $('.sticky-overlay').outerHeight($('.header').outerHeight());
  $('.page-banner-section').css('margin-top', $('.header').outerHeight());
});

$(window).on('load', function () {
  $('.cards-section.v1 .cards-wrp, .cards-section.v2 .cards-wrp, .cards-section.v3 .cards-wrp, .gallery-section.v1 .gallery-wrapper, .cards-section-new.slider .cards-wrp, .cards-section-new.grid .cards-wrp .testimonials-section .testimonials-row'
  ).flickity('resize');
});

// sticky menu
$(window).scroll(function () {
  var scroll = getCurrentScroll();
  if (scroll >= shrinkHeader) {
    $('body').addClass('sticky-header');
  } else {
    $('body').removeClass('sticky-header');
  }
});

function getCurrentScroll() {
  return window.pageYOffset || document.documentElement.scrollTop;
}
// sticky menu

function headerScripts() {
  // toggle class on hamburger icon click
  $('.mobile-burger-icon').click(function () {
    $('body, .mobile-burger-icon').toggleClass('show-menu');
  });

  // mobile sub menu navigation
  // level 1
  $('.mobile-menu .nav > li.menu-item-has-children').each(function () {
    $(this).find('> .sub-menu-wrap > .sub-menu').prepend('<div class="return-link">' + $(this).find('> a').text() + '</div>');
    $(this).find('> a').click(function (e) {
      e.preventDefault();
      $(this).siblings('.sub-menu-wrap').toggleClass('show-menu');
    });
  });

  // level 2
  $('.mobile-menu .nav > li.menu-item-has-children > .sub-menu-wrap li.menu-item-has-children').each(function () {
    $(this).find('> .sub-menu-wrap > .sub-menu').prepend('<div class="return-link">' + $(this).find('> a').text() + '</div>');
    $(this).find('> a').click(function (e) {
      e.preventDefault();
      $(this).siblings('.sub-menu-wrap').toggleClass('show-menu');
    });
  });

  // return link click
  $('.return-link').each(function () {
    $(this).click(function () {
      $(this).parent().parent('.sub-menu-wrap').removeClass('show-menu');
    });
  });

  // set header height to sticky overlay
  $('.sticky-overlay').outerHeight($('.header').outerHeight());
  $('.page-banner-section').css('margin-top', $('.header').outerHeight());
}

function formScripts() {
  if ($('.form-dropdown')) {
    $('.form-dropdown').each(function() {
      $(this).select2({
        dropdownParent: $(this).parent().parent(),
      });

      $('.button-wrp-outter').append($('.wpcf7-response-output'));
    });
  }
}

function cardSectionGridSlider() {
  $('.cards-section.v1 .cards-wrp').flickity({
    pageDots: true,
    prevNextButtons: false,
    wrapAround: true,
    watchCSS: true,
  });
}

function cardSectionSlider() {
  var cellAlignValue = '';

  if (matchMedia('screen and (max-width: 768px)').matches) {
    cellAlignValue = 'center';
  } else {
    cellAlignValue = 'left';
  }

  $('.cards-section.v2 .cards-wrp, .cards-section.v3 .cards-wrp').flickity({
    pageDots: true,
    prevNextButtons: true,
    wrapAround: true,
    cellAlign: cellAlignValue,
  });
}

function cardSectionGridSliderNew() {
  $('.cards-section-new.grid .cards-wrp').flickity({
    pageDots: true,
    prevNextButtons: false,
    wrapAround: true,
    watchCSS: true,
  });

  $('.cards-section-new.grid').each(function () {
    $(this).find('.flickity-button').appendTo($(this).find('.flickity-button-wrp'));
  });
}

function cardSectionSliderNew() {
  var cellAlignValue = '';

  if (matchMedia('screen and (max-width: 768px)').matches) {
    cellAlignValue = 'center';
  } else {
    cellAlignValue = 'left';
  }

  $('.cards-section-new.slider .cards-wrp').flickity({
    pageDots: true,
    prevNextButtons: true,
    wrapAround: true,
    cellAlign: cellAlignValue,
  });

  $('.cards-section-new.slider').each(function () {
    $(this).find('.flickity-button').appendTo($(this).find('.flickity-button-wrp'));
  });
}

function gallerySectionSlider() {
  var cellAlignValue = '';

  if (matchMedia('screen and (max-width: 768px)').matches) {
    cellAlignValue = 'center';
  } else {
    cellAlignValue = 'left';
  }

  $('.gallery-section.v1 .gallery-wrapper').flickity({
    pageDots: true,
    prevNextButtons: true,
    wrapAround: true,
    adaptiveHeight: true,
    cellAlign: cellAlignValue,
  });
}

// Implementation of Jquery Viewer
function jqueryViewer(ulId) {
  var $galleryImages = $(ulId);

  $galleryImages.each(function() {
    $galleryImages.viewer({
      tooltip: 0,
      inline: false,
      toolbar: {
        zoomIn: {
          show: 1,
          size: 'large',
        },
        zoomOut: {
          show: 1,
          size: 'large',
        },
        oneToOne: 0,
        reset: 0,
        prev: {
          show: 1,
          size: 'large',
        },
        play: {
          show: 0,
          size: 'large',
        },
        next: {
          show: 1,
          size: 'large',
        },
        rotateLeft: 0,
        rotateRight: 0,
        flipHorizontal: 0,
        flipVertical: 0,
      },
      title: 0,
      viewed: function () {
        $galleryImages.viewer('zoomTo', 1);
      },
    });
  });
}
// Implementation of Jquery Viewer

// Full Width Video Player
function fullWidthVideoPlayerFile() {
  for (let i = 1; i <= $('.playvideo.video-file').length ; i++) {
    let idName = 'play-video-' + i;
    let newIdName = 'video-iframe-' + i;
    $('.playvideo.video-file')[i-1].setAttribute('id', idName);
    $('.iframe-video.video-file')[i-1].setAttribute('id', newIdName);
    $('#'+idName).click(function(){

      if ($('#'+newIdName).hasClass('video-element')) {
        $('#'+ newIdName).css('opacity','1');
        $('#'+ newIdName).get(0).play();
        $('#' + idName).css({
          'opacity' : '0',
          'z-index' : '-1',
        });
      } else {
        $('#'+ newIdName).css('opacity','1');
        $('#'+ newIdName)[0].src += '&autoplay=1';
        $('#' + idName).css({
          'opacity' : '0',
          'z-index' : '-1',
        });
      }
    });
  }
}

function fullWidthVideoPlayerLink() {
  for (let i = 1; i <= $('.playvideo.video-url').length ; i++) {
    let idName = 'play-video-' + i;
    let newIdName = 'video-iframe-' + i;
    $('.playvideo.video-url')[i-1].setAttribute('id', idName);
    $('.iframe-video.video-url')[i-1].setAttribute('id', newIdName);
    $('#'+idName).click(function(){

      if ($('#'+newIdName).hasClass('video-element')) {
        $('#'+ newIdName).css('opacity','1');
        $('#'+ newIdName).get(0).play();
        $('#' + idName).css({
          'opacity' : '0',
          'z-index' : '-1',
        });
      } else {
        $('#'+ newIdName).css('opacity','1');
        $('#'+ newIdName)[0].src += '&autoplay=1';
        $('#' + idName).css({
          'opacity' : '0',
          'z-index' : '-1',
        });
      }
    });
  }
}
// Full Width Video Player

// Popup Video Player for Two Column Section
function videoPopupPlayerFile() {
  var videoSrc;
  var videoControls;
  $('.video-iframe-thumbnail.video-file').click(function () {
    videoSrc = $(this).data('src');
    videoControls = $(this).data('controls');
  });

  $('#myModal.video-file').on('shown.bs.modal', function () {
    $('#video').attr(
      'src',
      videoSrc + '?autoplay=1&mute=1&amp&modestbranding=1&amp&'+ videoControls+'&showinfo=0;'
    );
  });

  $('#myModal').on('hide.bs.modal', function () {
    $('#video').attr('src', videoSrc);
  });
}

function videoPopupPlayerLink() {
  var videoSrc;
  var videoControls;
  $('.video-iframe-thumbnail.video-url').click(function () {
    videoSrc = $(this).data('src');
    videoControls = $(this).data('controls');
  });

  $('#myModal.video-url').on('shown.bs.modal', function () {
    $('#video').attr(
      'src',
      videoSrc + '?autoplay=1&mute=1&amp&modestbranding=1&amp&'+ videoControls+'&showinfo=0;'
    );
  });

  $('#myModal').on('hide.bs.modal', function () {
    $('#video').attr('src', videoSrc);
  });
}
// Popup Video Player for Two Column Section

// Delay Home Banner Video Link
function delayHomeBannerVideoLink() {
  setTimeout(function() {
    $('#home-banner-iframe').attr('src',$('#hidden-iframe-url').text());
  }, 3000);
}
// Delay Home Banner Video Link

// Delay Home Banner Video File
function delayHomeBannerVideoFile() {
  setTimeout(function() {
    $('#home-banner-video').attr('src',$('#hidden-video-file').text());
  }, 3000);
}
// Delay Home Banner Video File

function editorContentAdditions() {
  //wrap all buttons with a wrapper to handle responsive - This works with "Add Buttons" feature in the wp editor
  var target = '.btn',
      invert = ':not(' + target + ')',
      wrap = '<div class="button-wrapper">',
      breakpoints = $('.editor-content-wrp > *'+invert);

  $('.editor-content-wrp').each(function( ) {
    $(this).find('.btn').unwrap();
  });

  breakpoints.each(function(){
    $(this).nextUntil(invert).wrapAll(wrap);
  });

  breakpoints.first().prevUntil(invert).wrapAll(wrap);
  //wrap all buttons with a wrapper to handle responsive - This works with "Add Buttons" feature in the wp editor
}

function logoSectionGridSlider() {
  $('.logo-section .logo-grid').flickity({
    pageDots: true,
    prevNextButtons: false,
    wrapAround: true,
    adaptiveHeight: true,
    watchCSS: true,
  });
}

function logoSectionSlider(slideshowEl) {
  if ($('.logo-section .logo-slider').children().length > 6) {
    // Play with this value to change the speed
    let tickerSpeed = 1;

    let flickity = null;
    let isPaused = false;
    // const slideshowEl = document.querySelector('.logo-section .logo-slider');

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

function testimonialGridSlider() {
  var cellAlignValue = '';

  if (matchMedia('screen and (max-width: 768px)').matches) {
    cellAlignValue = 'center';
  } else {
    cellAlignValue = 'left';
  }

  $('.testimonials-section.grid .testimonials-row').flickity({
    pageDots: true,
    prevNextButtons: true,
    wrapAround: true,
    watchCSS: true,
    cellAlign: cellAlignValue,
  });

  $('.testimonials-section.grid').each(function () {
    $(this).find('.flickity-button').appendTo($(this).find('.flickity-button-wrp'));
  });
}

function testimonialSlider() {
  var cellAlignValue = '';

  if (matchMedia('screen and (max-width: 768px)').matches) {
    cellAlignValue = 'center';
  } else {
    cellAlignValue = 'left';
  }

  $('.testimonials-section.slider .testimonials-row').flickity({
    pageDots: true,
    prevNextButtons: true,
    wrapAround: true,
    cellAlign: cellAlignValue,
  });

  $('.testimonials-section.slider').each(function () {
    $(this).find('.flickity-button').appendTo($(this).find('.flickity-button-wrp'));
  });
}

function loadMore() {
  $('.left-items .news-item-wrp').slice(0, 1).show();
  $('.right-items .news-item-wrp').slice(0, 1).show();
  if ($('.left-items .news-item-wrp:hidden').length != 0 || $('.right-items .news-item-wrp:hidden').length != 0) {
    $('#loadMoreDesktop').show();
  } else {
    $('#loadMoreDesktop').hide();
  }
  $('#loadMoreDesktop').on('click', function (e) {
    e.preventDefault();
    $('.left-items .news-item-wrp:hidden').slice(0, 1).slideDown();
    $('.right-items .news-item-wrp:hidden').slice(0, 1).slideDown();
    if ($('.left-items .news-item-wrp:hidden').length == 0) {
      $('#loadMoreDesktop').text('No More to view').fadeOut('slow');
      $('#loadMoreDesktop').addClass('load-more-end');
    }
  });

  $('.mobile-items .news-item-wrp').slice(0, 2).show();
  if ($('.mobile-items .news-item-wrp:hidden').length != 0) {
    $('#loadMoreMobile').show();
  } else {
    $('#loadMoreMobile').hide();
  }
  $('#loadMoreMobile').on('click', function (e) {
    e.preventDefault();
    $('.mobile-items .news-item-wrp:hidden').slice(0, 2).slideDown();
    if ($('.mobile-items .news-item-wrp:hidden').length == 0) {
      $('#loadMoreMobile').text('No More to view').fadeOut('slow');
      $('#loadMoreMobile').addClass('load-more-end');
    }
  });
}

function cookieConsent() {
  let cookiePreferences = getCookie('popupCookieAllowed').split(',');
  if (cookiePreferences[0] == 'necessary%2Cperformance%2Cfunctional%2Ctargetting') {
    cookiePreferences = cookiePreferences[0].split('%2C');
  }
  // On-Load Cookie Popup and Fixed Icon
  if( getCookie('popupCookie') != 'submited'){
    if ($('#cookie-consent-section').length >= 1) {
      setTimeout(function() {
        $('#cookie-consent-section').slideDown('slow');
      }, 500);
    }
  } else {
    if (cookiePreferences.includes('functional')) {
      delayHomeBannerVideoLink();
      fullWidthVideoPlayerLink();
      videoPopupPlayerLink();
      $('.video-iframe-thumbnail.video-url').removeClass('disable-popup');
    } else {
      $('.video-iframe-thumbnail.video-url').addClass('disable-popup');
    }

    if ($('#fixed-cookie-logo').length >= 1) {
      setTimeout(function() {
        $('#fixed-cookie-logo').slideDown('slow');
      }, 500);
    }
  }
  // On-Load Cookie Popup and Fixed Icon

  // Accept All Button Click
  $('#accept-all-button').on('click', function () {
    $('#cookie-consent-section').slideUp('slow', function() {
      $('#fixed-cookie-logo').slideDown('slow');
    });
    setCookie('popupCookie', 'submited', 100);
    setCookie('popupCookieAllowed', ['necessary', 'performance', 'functional', 'targetting'], 100);
    delayHomeBannerVideoLink();
    fullWidthVideoPlayerLink();
    videoPopupPlayerLink();
    $('.video-iframe-thumbnail.video-url').removeClass('disable-popup');
  });
  // Accept All Button Click

  // Accept Necessary Button Click
  $('#accept-necessary-button').on('click', function () {
    $('#cookie-consent-section').slideUp('slow', function() {
      $('#fixed-cookie-logo').slideDown('slow');
    });
    setCookie('popupCookie', 'submited', 100);
    setCookie('popupCookieAllowed', ['necessary'], 100);
    deleteGoogleCookies();
    $('.video-iframe-thumbnail.video-url').addClass('disable-popup');
  });
  // Accept Necessary Button Click

  // Accept Customize Accept Button Click
  $('#confirm-preferences').on('click', function () {
    setCookie('popupCookie', 'submited', 100);
    let cookieOptions = [];
    if ($('#necessary-cookies-toggle').is(':checked')) {
      cookieOptions.push('necessary');
    }
    if ($('#performance-cookies-toggle').is(':checked')) {
      cookieOptions.push('performance');
    } else {
      deleteGoogleCookies();
    }
    if ($('#functional-cookies-toggle').is(':checked')) {
      cookieOptions.push('functional');
      delayHomeBannerVideoLink();
      fullWidthVideoPlayerLink();
      videoPopupPlayerLink();
      $('.video-iframe-thumbnail.video-url').removeClass('disable-popup');
    } else {
      $('.video-iframe-thumbnail.video-url').addClass('disable-popup');
    }
    if ($('#targetting-cookies-toggle').is(':checked')) {
      cookieOptions.push('targetting');
    }

    $('#cookiePopupModal').modal('hide');

    setCookie('popupCookieAllowed', cookieOptions, 100);
    $('#cookie-consent-section').slideUp('slow', function() {
      $('#fixed-cookie-logo').slideDown('slow');
    });
  });
  // Accept Customize Accept Button Click

  // Cookie Fixed Icon Click
  $('#fixed-cookie-logo').on('click', function () {
    let cookiePreferences = getCookie('popupCookieAllowed').split(',');
    if (cookiePreferences[0] == 'necessary%2Cperformance%2Cfunctional%2Ctargetting') {
      cookiePreferences = cookiePreferences[0].split('%2C');
    }

    if (cookiePreferences.includes('performance')) {
      $('#performance-cookies-toggle').prop('checked', true);
    } else {
      $('#performance-cookies-toggle').prop('checked', false);
    }

    if (cookiePreferences.includes('functional')) {
      $('#functional-cookies-toggle').prop('checked', true);
    } else {
      $('#functional-cookies-toggle').prop('checked', false);
    }

    if (cookiePreferences.includes('targetting')) {
      $('#targetting-cookies-toggle').prop('checked', true);
    } else {
      $('#targetting-cookies-toggle').prop('checked', false);
    }

    $('#fixed-cookie-logo').slideUp('slow', function() {
      $('#cookie-consent-section').slideDown('slow');
    });
  });
  // Cookie Fixed Icon Click
}

// Cookie Create, Delete and Get Values
function deleteCookie(cname) {
  document.cookie = cname+'=; Max-Age=-99999999;';
}

function getCookie(cname) {
  var name = cname + '=';
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = 'expires=' + d.toUTCString();
  document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}
// Cookie Create, Delete and Get Values

// Delete Google Analytic Cookies
function deleteGoogleCookies() {
  deleteCookie('_ga');
  deleteCookie('_ga_EXFNGAKKTZ');
}
// Delete Google Analytic Cookies