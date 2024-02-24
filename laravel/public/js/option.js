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
    optionSection.classList.add('option-section', 'mt-4');
    var optionNameSection = document.createElement('div');
    optionNameSection.classList.add('flex', 'items-center', 'mt-2');
    optionNameSection.innerHTML = "\n            <input type=\"text\" name=\"options[".concat(optionIndex, "][name]\" required class=\"peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6\" placeholder=\"\u30AA\u30D7\u30B7\u30E7\u30F3\u540D\u3092\u5165\u529B\">\n            <button class=\"remove-option text-gray-400 hover:text-gray-600 ml-2\" type=\"button\">&times;</button>\n        ");
    optionSection.appendChild(optionNameSection);
    var optionPriceSection = document.createElement('div');
    optionPriceSection.classList.add('flex', 'items-center', 'mt-2');
    optionPriceSection.innerHTML = "\n            <input type=\"number\" name=\"options[".concat(optionIndex, "][price]\" required class=\"peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6\" placeholder=\"\u4FA1\u683C\u3092\u5165\u529B\">\n            <button class=\"remove-option text-gray-400 hover:text-gray-600 ml-2\" type=\"button\">&times;</button>\n        ");
    optionSection.appendChild(optionPriceSection);
    var removeButtons = optionSection.querySelectorAll('.remove-option');
    removeButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        console.log('Remove option button clicked');
        optionSection.remove();
      });
    });
    console.log('Remove option button added');
    optionContainer.appendChild(optionSection);
    console.log('Option section added to container');
  });
});
/******/ })()
;