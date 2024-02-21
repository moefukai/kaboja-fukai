/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/order-handler.js ***!
  \***************************************/
document.addEventListener('DOMContentLoaded', function () {
  updateOptionSelections();
  updateTotalPrice();
  document.getElementById('total_number').addEventListener('change', function () {
    updateOptionSelections();
    updateTotalPrice();
  });
});
function updateOptionSelections() {
  var totalNumber = parseInt(document.getElementById('total_number').value);
  var optionContainer = document.getElementById('optionContainer');
  optionContainer.innerHTML = '';
  var _loop = function _loop(i) {
    var optionTemplate = document.getElementById('optionTemplate').content.cloneNode(true);
    var label = optionTemplate.querySelector('.option-label');
    label.textContent = "\u30AA\u30D7\u30B7\u30E7\u30F3\u9078\u629E (".concat(i + 1, "\u500B\u76EE):");
    var checkboxesContainer = optionTemplate.querySelector('.checkboxes');
    options.forEach(function (option) {
      var checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = "options[".concat(i, "][]");
      checkbox.value = option.id;
      checkbox.dataset.price = option.price;
      var label = document.createElement('label');
      label.appendChild(checkbox);
      label.appendChild(document.createTextNode(" ".concat(option.name, " (").concat(Math.round(option.price), "\u5186)")));
      checkboxesContainer.appendChild(label);
      checkboxesContainer.appendChild(document.createElement('br'));
    });
    optionContainer.appendChild(optionTemplate);
  };
  for (var i = 0; i < totalNumber; i++) {
    _loop(i);
  }
}
function updateTotalPrice() {
  var discountedPriceElement = document.querySelector('#discountedPrice');
  var menuPrice = discountedPriceElement ? parseFloat(discountedPriceElement.textContent.replace(/[^0-9.]/g, "")) : 0;
  var totalNumber = parseInt(document.getElementById('total_number').value);
  var totalPrice = menuPrice * totalNumber;
  document.querySelectorAll('.checkboxes input:checked').forEach(function (checkbox) {
    var checkboxPrice = checkbox.dataset.price ? parseFloat(checkbox.dataset.price) : 0; // data-priceが設定されていない場合は0とする
    totalPrice += checkboxPrice;
  });
  document.getElementById('totalPrice').textContent = Math.round(totalPrice); // 合計金額を整数で表示
}
document.getElementById('optionContainer').addEventListener('change', updateTotalPrice);
document.getElementById('total_number').addEventListener('change', updateTotalPrice); // 個数選択セレクトボックスの変更も監視

updateTotalPrice();
/******/ })()
;