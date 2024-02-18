document.addEventListener('DOMContentLoaded', async function() {
    console.log("イベントリスナーです")
    const menusContainer = document.getElementById('menus-container');
    const addMenuBtn = document.getElementById('add-menu-btn');
    const submitButton = document.getElementById('submit-form');

    async function fetchMenus() {
        const response = await fetch('/menus');
        if (!response.ok) {
            throw new Error('Menus fetching failed.');
        }
        return await response.json();
    }

    // async function fetchToppings(menuId) {
    //     const response = await fetch(`/menus/${menuId}/toppings`);
    //     if (!response.ok) {
    //         throw new Error('Toppings fetching failed.');
    //     }
    //     return await response.json();
    // }

    async function addMenuSelect() {
        const menuLabel = document.createElement('label');
        menuLabel.textContent = 'メニュー';
        menusContainer.appendChild(menuLabel);

        const menuSelect = document.createElement('select');
        menuSelect.classList.add('form-control', 'mb-2', 'menu-select');
        menusContainer.appendChild(menuSelect);

        const discountContainer = document.createElement('div');
        const discountLabel = document.createElement('label');
        discountLabel.textContent = '値引き額';
        discountContainer.appendChild(discountLabel);

        const discountSelect = document.createElement('select');
        discountSelect.classList.add('form-control', 'mb-2');
        for (let i = 0; i <= 200; i += 10) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = `${i}円`;
            discountSelect.appendChild(option);
        }
        discountContainer.appendChild(discountSelect);
        menusContainer.appendChild(discountContainer);

        // const toppingsContainer = document.createElement('div');
        // menusContainer.appendChild(toppingsContainer);

        const menus = await fetchMenus();
        menus.forEach(menu => {
            const option = document.createElement('option');
            option.value = menu.id;
            option.textContent = `${menu.name}（${Math.floor(menu.price)}円）`;
            menuSelect.appendChild(option);
        });

        // menuSelect.addEventListener('change', async () => {
        //     const menuId = menuSelect.value;
        //     console.log("選択されたメニューID:", menuId);
        //     // 既存のトッピングコンテナをクリア
        //     while (toppingsContainer.firstChild) {
        //         toppingsContainer.removeChild(toppingsContainer.firstChild);
        //     }
        //     toppingsContainer.setAttribute('data-menu-id', menuId);
        //     if (!menuId) return;
        //     try {
        //         const toppings = await fetchToppings(menuId);
        //         toppings.forEach(topping => {
        //             const toppingContainer = document.createElement('div');
        //             toppingContainer.classList.add('topping-container');
        //
        //             const checkbox = document.createElement('input');
        //             checkbox.type = 'checkbox';
        //             checkbox.name = `toppings[${menuId}][]`;
        //             checkbox.value = topping.id;
        //             checkbox.classList.add("topping-checkbox");
        //
        //             checkbox.addEventListener('change', function() {
        //                 if (this.checked) {
        //                     console.log(`チェックされました: ${topping.id}`);
        //                 } else {
        //                     console.log(`チェックが外されました: ${topping.id}`);
        //                 }
        //             });
        //
        //             const label = document.createElement('label');
        //             label.classList.add('topping-label');
        //             label.textContent = ` ${topping.name} (${Math.floor(topping.price)}円)`;
        //
        //             toppingContainer.appendChild(checkbox);
        //             toppingContainer.appendChild(label);
        //             toppingsContainer.appendChild(toppingContainer);
        //         });
        //     } catch (error) {
        //         console.error(error.message);
        //         toppingsContainer.innerHTML = 'トッピングの取得に失敗しました。';
        //     }
        // });
        menuSelect.dispatchEvent(new Event('change'));
    }

    addMenuBtn.addEventListener('click', addMenuSelect);

    submitButton.addEventListener('click', async function(event) {
        console.log('送信ボタンがクリックされました');
        event.preventDefault();

        const address = document.getElementById('address').value;
        const startTime = document.getElementById('start_time').value;
        const endTime = document.getElementById('end_time').value;
        console.log('フォームの値:', { address, startTime, endTime });

        const menus = [];
        document.querySelectorAll('.menu-select').forEach((menuSelect, index) => {
            const menuId = menuSelect.value;
            const discountSelects = document.querySelectorAll('.discount-select');
            const discount = discountSelects.length > index ? discountSelects[index].value : '0';
            console.log(`メニュー${index + 1}:`, { menuId, discount });
            // const toppings = Array.from(document.querySelectorAll(`.toppings-container[data-menu-id="${menuId}"] .topping-checkbox:checked`)).map(checkbox => checkbox.value);
            // console.log(`トッピング${index + 1}:`, toppings);

            // menus.push({ menuId, discount, toppings });
            menus.push({ menuId, discount });

        });
        console.log('menus:', menus);
        // .menu-selectにマッチするすべての要素を取得し、ログに出力
        const menuSelects = document.querySelectorAll('.menu-select');
        console.log('menu-select要素:', menuSelects);

        // 各要素の値もログに出力してみる
        menuSelects.forEach((select, index) => {
            console.log(`メニュー${index + 1}の値:`, select.value);
        });


        const data = {
            address,
            start_time: startTime,
            end_time: endTime,
            menus
        };
        console.log("送信データ:", JSON.stringify(data));


        try {
            const response = await fetch('/notice', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });
            console.log('送信試行');

            if (!response.ok) {
                throw new Error('Server response was not OK');
            }

            const result = await response.json();
            console.log('送信結果:', result);
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
