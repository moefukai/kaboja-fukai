document.addEventListener('DOMContentLoaded', function () {
    updateTotalPrice();
    // ここにトッピング選択や合計金額計算のロジックを追加
});

    let menuPrice = 500; // メニューの基本価格
    let discountedPrice = 450; // 値引き後の価格
    document.getElementById('menuName').innerText = 'サンプルメニュー'; // メニュー名
    document.getElementById('menuPrice').innerText = menuPrice;
    document.getElementById('discountedPrice').innerText = discountedPrice;

    function updateTotalPrice() {
    let totalNumber = parseInt(document.getElementById('total_number').value);
    let toppingPrice = parseInt(document.getElementById('topping').value);
    let totalPrice = (discountedPrice + toppingPrice) * totalNumber;
    document.getElementById('totalPrice').innerText = totalPrice;
}

    window.onload = updateTotalPrice;
