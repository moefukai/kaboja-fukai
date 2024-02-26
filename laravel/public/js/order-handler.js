/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/order-handler.js ***!
  \***************************************/
document.addEventListener('DOMContentLoaded', function () {
  updateOptionSelections();
  updateTotalPrice();
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
    var checkboxContainer = document.createElement('div');
    checkboxContainer.classList.add('custom-checkbox-container');
    var checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.id = "option-".concat(option.id);
    checkbox.classList.add('custom-checkbox-input');
    checkbox.value = option.id;
    checkbox.dataset.price = option.price; // data-price属性を追加

    var customCheckbox = document.createElement('span');
    customCheckbox.classList.add('custom-checkbox');
    var label = document.createElement('label');
    label.htmlFor = checkbox.id;
    label.classList.add('custom-checkbox-label');
    label.textContent = " ".concat(option.name, " (").concat(Math.round(option.price), "\u5186)");
    label.prepend(customCheckbox);
    checkboxContainer.append(checkbox, label);
    optionContainer.append(checkboxContainer);
    checkbox.addEventListener('change', function () {
      customCheckbox.classList.toggle('checked', checkbox.checked);
      updateTotalPrice(); // チェックボックスの状態が変更されたときに合計金額を更新
    });
  });
}
function updateTotalPrice() {
  var discountedPriceElement = document.getElementById('discountedPrice');
  if (!discountedPriceElement) return;
  var discountedPrice = parseFloat(discountedPriceElement.dataset.discountedPrice);
  var totalPrice = discountedPrice;
  document.querySelectorAll('#optionContainer input[type="checkbox"]:checked').forEach(function (checkbox) {
    totalPrice += parseFloat(checkbox.dataset.price); // data-price属性を使用して合計金額を計算
  });
  document.getElementById('totalPrice').textContent = Math.round(totalPrice);
  var totalPriceInput = document.getElementById('total_price');
  if (totalPriceInput) {
    totalPriceInput.value = Math.round(totalPrice);
  }
}
/******/ })()
;