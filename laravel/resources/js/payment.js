document.getElementById('addPaymentMethod').addEventListener('click', function() {
    const container = document.getElementById('paymentMethods');
    const newIndex = container.children.length;
    const newField = document.createElement('div');
    newField.classList.add('mt-4');

    newField.innerHTML = `
        <div class="flex items-center mt-2">
            <input type="text" id="paymentMethod${newIndex}" name="paymentMethods[]" required class="peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="支払い方法を入力">
            <button class="remove-payment text-gray-400 hover:text-gray-600 ml-2" type="button">&times;</button>
        </div>
    `;

    newField.querySelector('.remove-payment').addEventListener('click', function() {
        newField.remove();
    });

    container.appendChild(newField);
});
