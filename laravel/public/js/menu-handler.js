/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/menu-handler.js ***!
  \**************************************/
document.addEventListener('DOMContentLoaded', function () {
  console.log('Before adding event listener to #add-menu');
  var addButton = document.getElementById('add-menu');
  if (addButton) {
    addButton.addEventListener('click', function () {
      console.log('event fired.');
      var menuIndex = document.querySelectorAll('.menu-section').length;
      var menuSection = document.createElement('div');
      menuSection.classList.add('menu-section');
      menuSection.innerHTML = "\n                <hr>\n                <label>\u30E1\u30CB\u30E5\u30FC\u540D:</label>\n                <input type=\"text\" name=\"menus[".concat(menuIndex, "][name]\" required>\n                <label>\u4FA1\u683C:</label>\n                <input type=\"number\" name=\"menus[").concat(menuIndex, "][price]\" required>\n                <div>\n                    <input type=\"checkbox\" class=\"has-toppings\" name=\"menus[").concat(menuIndex, "][has_toppings]\"> \u30C8\u30C3\u30D4\u30F3\u30B0\u3042\u308A\n                    <div class=\"toppings-container\" style=\"display: none;\">\n                        <!-- \u3053\u3053\u306B\u30C8\u30C3\u30D4\u30F3\u30B0\u5165\u529B\u30BB\u30AF\u30B7\u30E7\u30F3\u3092\u52D5\u7684\u306B\u8FFD\u52A0 -->\n                    </div>\n                    <button type=\"button\" class=\"add-topping\">\u30C8\u30C3\u30D4\u30F3\u30B0\u3092\u8FFD\u52A0</button>\n                </div>\n            ");
      document.getElementById('menu-container').appendChild(menuSection);
      var toppingsContainer = menuSection.querySelector('.toppings-container');
      var addToppingButton = menuSection.querySelector('.add-topping');
      addToppingButton.addEventListener('click', function () {
        var toppingIndex = toppingsContainer.querySelectorAll('.topping-section').length;
        var toppingSection = document.createElement('div');
        toppingSection.classList.add('topping-section');
        toppingSection.innerHTML = "\n                <label>\u30C8\u30C3\u30D4\u30F3\u30B0\u540D:</label>\n                <input type=\"text\" name=\"menus[".concat(menuIndex, "][toppings][").concat(toppingIndex, "][name]\" required>\n                <label>\u4FA1\u683C:</label>\n                <input type=\"number\" name=\"menus[").concat(menuIndex, "][toppings][").concat(toppingIndex, "][price]\" required>\n            ");
        toppingsContainer.appendChild(toppingSection);
      });

      // トッピングありのチェックボックスの表示切り替え
      menuSection.querySelector('.has-toppings').addEventListener('change', function () {
        toppingsContainer.style.display = this.checked ? 'block' : 'none';
      });
    });
  } else {
    console.log('#add-menu button not found');
  }
  console.log('menu-handler.js is loaded');
});
/******/ })()
;