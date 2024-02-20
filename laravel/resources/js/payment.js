document.getElementById('addPaymentMethod').addEventListener('click', function() {
    const container = document.getElementById('paymentMethods');
    const newIndex = container.children.length + 1; // 新しいインデックスを計算
    const newField = document.createElement('div');

    newField.innerHTML = `
        <div>
            <label for="paymentMethod${newIndex}">支払い方法:</label>
            <input type="text" id="paymentMethod${newIndex}" name="paymentMethods[]" required>
            <button type="button" class="remove-payment">支払い方法を削除</button>
        </div>
    `;

    newField.querySelector('.remove-payment').addEventListener('click', function() {
        newField.remove();
    });

    container.appendChild(newField);
});
