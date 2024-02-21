document.addEventListener('DOMContentLoaded', async function() {
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

    async function addMenuSelect() {
        const menuDiv = document.createElement('div');
        const menuLabel = document.createElement('label');
        menuLabel.textContent = 'メニュー';
        menuDiv.appendChild(menuLabel);

        const menuSelect = document.createElement('select');
        menuSelect.classList.add('form-control', 'mb-2', 'menu-select');
        menuDiv.appendChild(menuSelect);

        const discountContainer = document.createElement('div');
        const discountLabel = document.createElement('label');
        discountLabel.textContent = '値引き額';
        discountContainer.appendChild(discountLabel);

        const discountSelect = document.createElement('select');
        discountSelect.classList.add('form-control', 'mb-2', 'discount-select');
        for (let i = 0; i <= 200; i += 10) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = `${i}円`;
            discountSelect.appendChild(option);
        }
        discountContainer.appendChild(discountSelect);
        menuDiv.appendChild(discountContainer);

        menusContainer.appendChild(menuDiv);

        discountSelect.addEventListener('change', function() {
            console.log('選択された値引き額:', this.value);
        });

        const menus = await fetchMenus();
        menus.forEach(menu => {
            const option = document.createElement('option');
            option.value = menu.id;
            option.textContent = `${menu.name}（${Math.floor(menu.price)}円）`;
            menuSelect.appendChild(option);
        });
    }

    addMenuBtn.addEventListener('click', addMenuSelect);

    submitButton.addEventListener('click', async function(event) {
        event.preventDefault();

        const address = document.getElementById('address').value;
        const startTime = document.getElementById('start_time').value;
        const endTime = document.getElementById('end_time').value;

        // メニューセレクトボックスと値引き額セレクトボックスの組み合わせを取得してデータを作成
        const menus = Array.from(document.querySelectorAll('.menu-select')).map((menuSelect, index) => {
            const discountSelect = document.querySelectorAll('.discount-select')[index]; // 同じインデックスの値引き額セレクトボックスを取得
            return {
                menuId: menuSelect.value, // メニューID
                discount: discountSelect ? discountSelect.value : '0' // 値引き額（未選択の場合は0を設定）
            };
        });

        const data = {
            address,
            start_time: startTime,
            end_time: endTime,
            menus
        };

        try {
            const response = await fetch('/notice', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Server response was not OK');
            }

            const result = await response.json();
            if (result.redirect_url) {
                window.location.href = result.redirect_url;
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
