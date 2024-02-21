/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/order-handler.js ***!
  \***************************************/
document.addEventListener('DOMContentLoaded', function () {
  updateOptionSelections();
  document.getElementById('total_number').addEventListener('change', updateOptionSelections);
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
/******/ })()
;