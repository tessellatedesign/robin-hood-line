/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./assets/js/functions.js ***!
  \********************************/
jQuery(function ($) {
  $('#header nav li.menu-item-has-children').click(function (e) {
    if (!$(this).hasClass('open') && $(window).width() < 992) {
      e.preventDefault();
      $(this).parent().find('.open ul').slideUp();
      $(this).parent().find('.open').removeClass('open');
      $(this).addClass('open').find('ul').slideDown();
    }
  });
  $('#header #menu-toggle').click(function () {
    $(this).toggleClass('open');
    $('#header nav .open').removeClass('open');
    $('#header nav').stop().slideToggle();
  });
  $('.woocommerce-MyAccount-navigation li.is-active').click(function (e) {
    if ($('li.is-active').is(e.target)) {
      $(this).parent().toggleClass('open');
    }
  });
});
/******/ })()
;