/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/orderMain.js ***!
  \***********************************/
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.menu-item').forEach(function (item) {
    item.addEventListener('click', function () {
      var noticeMenuId = this.getAttribute('data-notice-menu-id');
      window.location.href = "/order/detail/".concat(noticeMenuId);
    });
  });
});
/******/ })()
;