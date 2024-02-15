document.addEventListener('DOMContentLoaded', async function() {
    console.log("イベントリスナー")
    const menusContainer = document.getElementById('menus-container');
    const addMenuBtn = document.getElementById('add-menu-btn');

    async function fetchMenus() {
        const response = await fetch('/menus');
        if (!response.ok) {
            throw new Error('Menus fetching failed.');
        }
        return await response.json();
    }

    async function fetchToppings(menuId) {
        const response = await fetch(`/menus/${menuId}/toppings`);
        if (!response.ok) {
            throw new Error('Toppings fetching failed.');
        }
        return await response.json();
    }

    async function addMenuSelect() {
        const menuLabel = document.createElement('label');
        menuLabel.textContent = 'メニュー';
        menusContainer.appendChild(menuLabel);

        const menuSelect = document.createElement('select');
        menuSelect.classList.add('form-control', 'mb-2');
        menusContainer.appendChild(menuSelect);

        const toppingsContainer = document.createElement('div');
        menusContainer.appendChild(toppingsContainer);

        const menus = await fetchMenus();
        menus.forEach(menu => {
            const option = document.createElement('option');
            option.value = menu.id;
            option.textContent = `${menu.name}（￥${Math.floor(menu.price)}）`;
            menuSelect.appendChild(option);
        });

        menuSelect.addEventListener('change', async () => {
            const menuId = menuSelect.value;
            toppingsContainer.innerHTML = ''; // Clear previous toppings
            if (!menuId) return; // Exit if no menu is selected
            try {
                const toppings = await fetchToppings(menuId);
                toppings.forEach(topping => {
                    const label = document.createElement('label');
                    label.textContent = `${topping.name} (￥${Math.floor(topping.price)})`;
                    const checkbox = document.createElement('input');
                    const menuLabel = document.createElement('label');
                    menuLabel.textContent = 'トッピング';
                    menusContainer.appendChild(menuLabel);
                    checkbox.type = 'checkbox';
                    checkbox.name = `toppings[${menuId}][]`;
                    checkbox.value = topping.id;
                    toppingsContainer.appendChild(label);
                    toppingsContainer.appendChild(checkbox);
                    toppingsContainer.appendChild(document.createElement('br'));
                });
            } catch (error) {
                console.error(error.message);
                toppingsContainer.innerHTML = 'トッピングの取得に失敗しました。';
            }
        });

        // Trigger change to load initial toppings
        menuSelect.dispatchEvent(new Event('change'));
    }

    // await addMenuSelect(); // Add the initial menu select on load

    addMenuBtn.addEventListener('click', addMenuSelect); // Add more menus on button click
});
