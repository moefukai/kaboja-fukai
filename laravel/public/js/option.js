/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/option.js ***!
  \********************************/
document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM fully loaded and parsed');
  var optionContainer = document.getElementById('option-container');
  var addOptionButton = document.getElementById('add-option');
  addOptionButton.addEventListener('click', function () {
    console.log('Add option button clicked');
    var optionIndex = document.querySelectorAll('.option-section').length;
    var optionSection = document.createElement('div');
    optionSection.classList.add('option-section');
    optionSection.innerHTML = "\n            <hr>\n            <label>\u30AA\u30D7\u30B7\u30E7\u30F3\u540D:</label>\n            <input type=\"text\" name=\"options[".concat(optionIndex, "][name]\" required>\n            <label>\u4FA1\u683C:</label>\n            <input type=\"number\" name=\"options[").concat(optionIndex, "][price]\" required>\n        ");
    var removeOptionButton = document.createElement('button');
    removeOptionButton.textContent = 'オプションを削除';
    removeOptionButton.type = 'button';
    removeOptionButton.classList.add('remove-option');
    removeOptionButton.addEventListener('click', function () {
      console.log('Remove option button clicked');
      optionSection.remove();
    });
    optionSection.appendChild(removeOptionButton);
    console.log('Remove option button added');
    optionContainer.appendChild(optionSection);
    console.log('Option section added to container');
  });
});
/******/ })()
;