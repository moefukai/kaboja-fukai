/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/payment.js ***!
  \*********************************/
document.getElementById('addPaymentMethod').addEventListener('click', function () {
  var container = document.getElementById('paymentMethods');
  var newIndex = container.children.length + 1; // 新しいインデックスを計算
  var newField = document.createElement('div');
  newField.innerHTML = "\n        <div>\n            <label for=\"paymentMethod".concat(newIndex, "\">\u652F\u6255\u3044\u65B9\u6CD5:</label>\n            <input type=\"text\" id=\"paymentMethod").concat(newIndex, "\" name=\"paymentMethods[]\" required>\n            <button type=\"button\" class=\"remove-payment\">\u652F\u6255\u3044\u65B9\u6CD5\u3092\u524A\u9664</button>\n        </div>\n    ");
  newField.querySelector('.remove-payment').addEventListener('click', function () {
    newField.remove();
  });
  container.appendChild(newField);
});
/******/ })()
;