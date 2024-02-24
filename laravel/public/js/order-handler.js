/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/order-handler.js ***!
  \***************************************/
document.addEventListener('DOMContentLoaded', function () {
  // オプション選択肢の更新
  updateOptionSelections();
  // 合計価格の更新
  updateTotalPrice();
  // オプションの変更時に合計価格を更新
  var optionContainerElement = document.getElementById('optionContainer');
  if (optionContainerElement) {
    optionContainerElement.addEventListener('change', function (e) {
      if (e.target.type === 'checkbox') {
        updateTotalPrice();
      }
    });
  }
});
function updateOptionSelections() {
  var optionContainer = document.getElementById('optionContainer');
  if (!optionContainer) return;
  optionContainer.innerHTML = '';
  options.forEach(function (option) {
    var checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.name = "options[]";
    checkbox.value = option.id;
    checkbox.dataset.price = option.price;
    var label = document.createElement('label');
    label.appendChild(checkbox);
    label.appendChild(document.createTextNode(" ".concat(option.name, " (").concat(Math.round(option.price), "\u5186)")));
    optionContainer.appendChild(label);
    optionContainer.appendChild(document.createElement('br'));
  });
}
function updateTotalPrice() {
  var discountedPriceElement = document.getElementById('discountedPrice');
  if (!discountedPriceElement) return;
  var discountedPrice = parseFloat(discountedPriceElement.dataset.discountedPrice);
  var totalPrice = discountedPrice;
  document.querySelectorAll('#optionContainer input[type="checkbox"]:checked').forEach(function (checkbox) {
    totalPrice += parseFloat(checkbox.dataset.price);
  });
  document.getElementById('totalPrice').textContent = Math.round(totalPrice);
  var totalPriceInput = document.getElementById('total_price');
  if (totalPriceInput) {
    totalPriceInput.value = Math.round(totalPrice);
  }
}
/******/ })()
;