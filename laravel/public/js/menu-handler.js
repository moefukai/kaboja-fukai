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
    menuSection.classList.add('menu-section');
    menuSection.innerHTML = "\n            <hr>\n            <label>\u30E1\u30CB\u30E5\u30FC\u540D:</label>\n            <input type=\"text\" name=\"menus[".concat(menuIndex, "][name]\" required>\n            <label>\u4FA1\u683C:</label>\n            <input type=\"number\" name=\"menus[").concat(menuIndex, "][price]\" required>\n            <div>\n                <input type=\"checkbox\" class=\"has-toppings\" name=\"menus[").concat(menuIndex, "][has_toppings]\"> \u30C8\u30C3\u30D4\u30F3\u30B0\u3042\u308A\n                <div class=\"toppings-container\" style=\"display: none;\"></div>\n                <button type=\"button\" class=\"add-topping\">\u30C8\u30C3\u30D4\u30F3\u30B0\u3092\u8FFD\u52A0</button>\n            </div>\n        ");
    var removeMenuButton = document.createElement('button');
    removeMenuButton.textContent = 'メニューを削除';
    removeMenuButton.type = 'button';
    removeMenuButton.classList.add('remove-menu'); // CSSでスタイリングする場合に使用するクラス
    menuSection.appendChild(removeMenuButton);

    // 削除ボタンのイベントリスナーを追加
    removeMenuButton.addEventListener('click', function () {
      console.log('Remove menu button clicked');
      menuSection.remove();
    });
    menuSection.appendChild(removeMenuButton);
    console.log('Remove menu button added');
    removeMenuButton.addEventListener('click', function () {
      menuSection.remove();
    });
    menuContainer.appendChild(menuSection);
    console.log('Menu section added to container');
    menuSection.querySelector('.add-topping').addEventListener('click', function () {
      console.log('Add topping button clicked');
      var toppingIndex = menuSection.querySelectorAll('.topping-section').length;
      var toppingSection = document.createElement('div');
      toppingSection.classList.add('topping-section');
      toppingSection.innerHTML = "\n                <label>\u30C8\u30C3\u30D4\u30F3\u30B0\u540D:</label>\n                <input type=\"text\" name=\"menus[".concat(menuIndex, "][toppings][").concat(toppingIndex, "][name]\" required>\n                <label>\u4FA1\u683C:</label>\n                <input type=\"number\" name=\"menus[").concat(menuIndex, "][toppings][").concat(toppingIndex, "][price]\" required>\n                <button type=\"button\" class=\"remove-topping\">\u30C8\u30C3\u30D4\u30F3\u30B0\u3092\u524A\u9664</button>\n            ");
      var removeToppingButton = toppingSection.querySelector('.remove-topping');
      removeToppingButton.addEventListener('click', function () {
        console.log('Remove topping button clicked');
        toppingSection.remove();
      });
      console.log('Remove topping button added and event listener set');
      menuSection.querySelector('.toppings-container').appendChild(toppingSection);
      console.log('Topping section added to container');
    });
    menuSection.querySelector('.has-toppings').addEventListener('change', function () {
      console.log('Toppings visibility toggled');
      menuSection.querySelector('.toppings-container').style.display = this.checked ? 'block' : 'none';
    });
  });
});
/******/ })()
;