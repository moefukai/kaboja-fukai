/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/menuItems.js ***!
  \***********************************/
document.addEventListener('DOMContentLoaded', function () {
  var menuItems = JSON.parse(document.getElementById('menuItemsData').textContent);
  var container = document.getElementById('menuItemsContainer');
  menuItems.forEach(function (item, index) {
    var menuNameInput = document.createElement('input');
    menuNameInput.type = 'hidden';
    menuNameInput.name = "menus[".concat(index, "][name]");
    menuNameInput.value = item.menu.name;
    container.appendChild(menuNameInput);
    var priceInput = document.createElement('input');
    priceInput.type = 'hidden';
    priceInput.name = "menus[".concat(index, "][price]");
    priceInput.value = item.menu.price;
    container.appendChild(priceInput);
    var discountInput = document.createElement('input');
    discountInput.type = 'hidden';
    discountInput.name = "menus[".concat(index, "][discount]");
    discountInput.value = item.discount;
    container.appendChild(discountInput);
  });
});
/******/ })()
;