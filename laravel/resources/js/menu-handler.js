document.addEventListener('DOMContentLoaded', function() {
    console.log('Before adding event listener to #add-menu');
    var addButton = document.getElementById('add-menu');
    if (addButton) {
        addButton.addEventListener('click', function() {
            console.log('event fired.');
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
                    <div class="toppings-container" style="display: none;">
                        <!-- ここにトッピング入力セクションを動的に追加 -->
                    </div>
                    <button type="button" class="add-topping">トッピングを追加</button>
                </div>
            `;
            document.getElementById('menu-container').appendChild(menuSection);

            const toppingsContainer = menuSection.querySelector('.toppings-container');
            const addToppingButton = menuSection.querySelector('.add-topping');
            addToppingButton.addEventListener('click', function() {
                const toppingIndex = toppingsContainer.querySelectorAll('.topping-section').length;
                let toppingSection = document.createElement('div');
                toppingSection.classList.add('topping-section');
                toppingSection.innerHTML = `
                <label>トッピング名:</label>
                <input type="text" name="menus[${menuIndex}][toppings][${toppingIndex}][name]" required>
                <label>価格:</label>
                <input type="number" name="menus[${menuIndex}][toppings][${toppingIndex}][price]" required>
            `;
                toppingsContainer.appendChild(toppingSection);
            });

            // トッピングありのチェックボックスの表示切り替え
            menuSection.querySelector('.has-toppings').addEventListener('change', function() {
                toppingsContainer.style.display = this.checked ? 'block' : 'none';
            });
        });
    } else {
        console.log('#add-menu button not found');
    }

    console.log('menu-handler.js is loaded');
});
