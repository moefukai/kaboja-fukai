document.addEventListener('DOMContentLoaded', function () {
    // オプション選択肢の更新
    updateOptionSelections();
    // 合計価格の更新
    updateTotalPrice();
    // オプションの変更時に合計価格を更新
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
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = `options[]`;
        checkbox.value = option.id;
        checkbox.dataset.price = option.price;

        const label = document.createElement('label');
        label.appendChild(checkbox);
        label.appendChild(document.createTextNode(` ${option.name} (${Math.round(option.price)}円)`));

        optionContainer.appendChild(label);
        optionContainer.appendChild(document.createElement('br'));
    });
}

function updateTotalPrice() {
    const discountedPriceElement = document.getElementById('discountedPrice');
    if (!discountedPriceElement) return;

    const discountedPrice = parseFloat(discountedPriceElement.dataset.discountedPrice);
    let totalPrice = discountedPrice;

    document.querySelectorAll('#optionContainer input[type="checkbox"]:checked').forEach(function(checkbox) {
        totalPrice += parseFloat(checkbox.dataset.price);
    });

    document.getElementById('totalPrice').textContent = Math.round(totalPrice);
    const totalPriceInput = document.getElementById('total_price');
    if (totalPriceInput) {
        totalPriceInput.value = Math.round(totalPrice);
    }
}
