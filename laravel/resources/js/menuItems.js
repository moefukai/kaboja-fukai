document.addEventListener('DOMContentLoaded', function() {
    const menuItems = JSON.parse(document.getElementById('menuItemsData').textContent);
    const container = document.getElementById('menuItemsContainer');

    menuItems.forEach((item, index) => {
        const menuNameInput = document.createElement('input');
        menuNameInput.type = 'hidden';
        menuNameInput.name = `menus[${index}][name]`;
        menuNameInput.value = item.menu.name;
        container.appendChild(menuNameInput);

        const priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = `menus[${index}][price]`;
        priceInput.value = item.menu.price;
        container.appendChild(priceInput);

        const discountInput = document.createElement('input');
        discountInput.type = 'hidden';
        discountInput.name = `menus[${index}][discount]`;
        discountInput.value = item.discount;
        container.appendChild(discountInput);
    });
});
