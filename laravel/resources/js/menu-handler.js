document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    const menuContainer = document.getElementById('menu-container');
    const addMenuButton = document.getElementById('add-menu');

    addMenuButton.addEventListener('click', function() {
        console.log('Add menu button clicked');
        const menuIndex = document.querySelectorAll('.menu-section').length;
        let menuSection = document.createElement('div');
        menuSection.classList.add('menu-section');
        menuSection.innerHTML = `
            <hr>
            <label>メニュー名:</label>
            <input type="text" name="menus[${menuIndex}][name]" required>
            <label>価格:</label>
            <input type="number" name="menus[${menuIndex}][price]" required>
            <div>
                <input type="checkbox" class="has-toppings" name="menus[${menuIndex}][has_toppings]"> トッピングあり
                <div class="toppings-container" style="display: none;"></div>
                <button type="button" class="add-topping">トッピングを追加</button>
            </div>
        `;
        const removeMenuButton = document.createElement('button');
        removeMenuButton.textContent = 'メニューを削除';
        removeMenuButton.type = 'button';
        removeMenuButton.classList.add('remove-menu'); // CSSでスタイリングする場合に使用するクラス
        menuSection.appendChild(removeMenuButton);

        // 削除ボタンのイベントリスナーを追加
        removeMenuButton.addEventListener('click', function() {
            console.log('Remove menu button clicked');
            menuSection.remove();
        });
        menuSection.appendChild(removeMenuButton);
        console.log('Remove menu button added');

        removeMenuButton.addEventListener('click', function() { menuSection.remove(); });

        menuContainer.appendChild(menuSection);
        console.log('Menu section added to container');

        menuSection.querySelector('.add-topping').addEventListener('click', function() {
            console.log('Add topping button clicked');
            const toppingIndex = menuSection.querySelectorAll('.topping-section').length;
            const toppingSection = document.createElement('div');
            toppingSection.classList.add('topping-section');
            toppingSection.innerHTML = `
                <label>トッピング名:</label>
                <input type="text" name="menus[${menuIndex}][toppings][${toppingIndex}][name]" required>
                <label>価格:</label>
                <input type="number" name="menus[${menuIndex}][toppings][${toppingIndex}][price]" required>
                <button type="button" class="remove-topping">トッピングを削除</button>
            `;

            const removeToppingButton = toppingSection.querySelector('.remove-topping');
            removeToppingButton.addEventListener('click', function() {
                console.log('Remove topping button clicked');
                toppingSection.remove();
            });
            console.log('Remove topping button added and event listener set');

            menuSection.querySelector('.toppings-container').appendChild(toppingSection);
            console.log('Topping section added to container');
        });

        menuSection.querySelector('.has-toppings').addEventListener('change', function() {
            console.log('Toppings visibility toggled');
            menuSection.querySelector('.toppings-container').style.display = this.checked ? 'block' : 'none';
        });
    });
});
