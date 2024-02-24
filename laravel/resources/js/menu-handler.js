document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    const menuContainer = document.getElementById('menu-container');
    const addMenuButton = document.getElementById('add-menu');

    addMenuButton.addEventListener('click', function() {
        console.log('Add menu button clicked');
        const menuIndex = document.querySelectorAll('.menu-section').length;
        let menuSection = document.createElement('div');
        menuSection.classList.add('menu-section', 'mt-4');

        const menuNameSection = document.createElement('div');
        menuNameSection.classList.add('flex', 'items-center', 'mt-2');
        menuNameSection.innerHTML = `
            <input type="text" name="menus[${menuIndex}][name]" required class="peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="メニュー名を入力">
            <button class="remove-menu text-gray-400 hover:text-gray-600 ml-2" type="button">&times;</button>
        `;
        menuSection.appendChild(menuNameSection);

        const menuPriceSection = document.createElement('div');
        menuPriceSection.classList.add('flex', 'items-center', 'mt-2');
        menuPriceSection.innerHTML = `
            <input type="number" name="menus[${menuIndex}][price]" required class="peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="価格を入力">
            <button class="remove-menu text-gray-400 hover:text-gray-600 ml-2" type="button">&times;</button>
        `;
        menuSection.appendChild(menuPriceSection);

        const removeButtons = menuSection.querySelectorAll('.remove-menu');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Remove menu button clicked');
                menuSection.remove();
            });
        });

        console.log('Remove menu button added');
        menuContainer.appendChild(menuSection);
        console.log('Menu section added to container');
    });
});
