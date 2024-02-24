/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/menu-handler.js ***!
  \**************************************/
document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM fully loaded and parsed');
  var menuContainer = document.getElementById('menu-container');
  var addMenuButton = document.getElementById('add-menu');
  addMenuButton.addEventListener('click', function () {
    console.log('Add menu button clicked');
    var menuIndex = document.querySelectorAll('.menu-section').length;
    var menuSection = document.createElement('div');
    menuSection.classList.add('menu-section', 'mt-4');
    var menuNameSection = document.createElement('div');
    menuNameSection.classList.add('flex', 'items-center', 'mt-2');
    menuNameSection.innerHTML = "\n            <input type=\"text\" name=\"menus[".concat(menuIndex, "][name]\" required class=\"peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6\" placeholder=\"\u30E1\u30CB\u30E5\u30FC\u540D\u3092\u5165\u529B\">\n            <button class=\"remove-menu text-gray-400 hover:text-gray-600 ml-2\" type=\"button\">&times;</button>\n        ");
    menuSection.appendChild(menuNameSection);
    var menuPriceSection = document.createElement('div');
    menuPriceSection.classList.add('flex', 'items-center', 'mt-2');
    menuPriceSection.innerHTML = "\n            <input type=\"number\" name=\"menus[".concat(menuIndex, "][price]\" required class=\"peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6\" placeholder=\"\u4FA1\u683C\u3092\u5165\u529B\">\n            <button class=\"remove-menu text-gray-400 hover:text-gray-600 ml-2\" type=\"button\">&times;</button>\n        ");
    menuSection.appendChild(menuPriceSection);
    var removeButtons = menuSection.querySelectorAll('.remove-menu');
    removeButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        console.log('Remove menu button clicked');
        menuSection.remove();
      });
    });
    console.log('Remove menu button added');
    menuContainer.appendChild(menuSection);
    console.log('Menu section added to container');
  });
});
/******/ })()
;