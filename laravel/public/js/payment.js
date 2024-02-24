/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/payment.js ***!
  \*********************************/
document.getElementById('addPaymentMethod').addEventListener('click', function () {
  var container = document.getElementById('paymentMethods');
  var newIndex = container.children.length;
  var newField = document.createElement('div');
  newField.classList.add('mt-4');
  newField.innerHTML = "\n        <div class=\"flex items-center mt-2\">\n            <input type=\"text\" id=\"paymentMethod".concat(newIndex, "\" name=\"paymentMethods[]\" required class=\"peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6\" placeholder=\"\u652F\u6255\u3044\u65B9\u6CD5\u3092\u5165\u529B\">\n            <button class=\"remove-payment text-gray-400 hover:text-gray-600 ml-2\" type=\"button\">&times;</button>\n        </div>\n    ");
  newField.querySelector('.remove-payment').addEventListener('click', function () {
    newField.remove();
  });
  container.appendChild(newField);
});
/******/ })()
;