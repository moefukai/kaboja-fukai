document.addEventListener('DOMContentLoaded', function () {
    updateOptionSelections();
    updateTotalPrice();
    const optionContainerElement = document.getElementById('optionContainer');
    if (optionContainerElement) {
        optionContainerElement.addEventListener('change', function(e) {
            if (e.target.type === 'checkbox') {
                updateTotalPrice();
            }
        });
    }
});

function updateOptionSelections() {
    const optionContainer = document.getElementById('optionContainer');
    if (!optionContainer) return;

    optionContainer.innerHTML = '';

    options.forEach(option => {
        const checkboxContainer = document.createElement('div');
        checkboxContainer.classList.add('custom-checkbox-container');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = `option-${option.id}`;
        checkbox.classList.add('custom-checkbox-input');
        checkbox.value = option.id;
        checkbox.dataset.price = option.price; // data-price属性を追加

        const customCheckbox = document.createElement('span');
        customCheckbox.classList.add('custom-checkbox');

        const label = document.createElement('label');
        label.htmlFor = checkbox.id;
        label.classList.add('custom-checkbox-label');
        label.textContent = ` ${option.name} (${Math.round(option.price)}円)`;
        label.prepend(customCheckbox);

        checkboxContainer.append(checkbox, label);
        optionContainer.append(checkboxContainer);

        checkbox.addEventListener('change', () => {
            customCheckbox.classList.toggle('checked', checkbox.checked);
            updateTotalPrice(); // チェックボックスの状態が変更されたときに合計金額を更新
        });
    });
}

function updateTotalPrice() {
    const discountedPriceElement = document.getElementById('discountedPrice');
    if (!discountedPriceElement) return;

    const discountedPrice = parseFloat(discountedPriceElement.dataset.discountedPrice);
    let totalPrice = discountedPrice;

    document.querySelectorAll('#optionContainer input[type="checkbox"]:checked').forEach(function(checkbox) {
        totalPrice += parseFloat(checkbox.dataset.price); // data-price属性を使用して合計金額を計算
    });

    document.getElementById('totalPrice').textContent = Math.round(totalPrice);
    const totalPriceInput = document.getElementById('total_price');
    if (totalPriceInput) {
        totalPriceInput.value = Math.round(totalPrice);
    }
}
