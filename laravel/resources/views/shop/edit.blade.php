<form action="{{ route('shops.update', $shop->id) }}" method="post">
    @csrf
    @method('POST')
    <div>
        <label for="name">店名:</label>
        <input type="text" id="name" name="name" value="{{ $shop->name }}" required>
    </div>
    <div>
        <label for="contact">連絡先:</label>
        <input type="text" id="contact" name="contact" value="{{ $shop->contact }}" required>
    </div>
    <div class="menus">
        <div>
            <label for="contact">メニュー①:</label>
            <input type="text" id="menu1" name="menu1" required>
            <label for="contact">値段:</label>
            <input type="text" id="menu1-price" name="menu1-price" required>
        </div>
        <div>
            <label for="contact">メニュー②:</label>
            <input type="text" id="menu2" name="menu2" required>
            <label for="contact">値段:</label>
            <input type="text" id="menu2-price" name="menu2-price" required>
        </div>
        <div>
            <label for="contact">メニュー③:</label>
            <input type="text" id="menu3" name="menu3" required>
            <label for="contact">値段:</label>
            <input type="text" id="menu3-price" name="menu3-price" required>
        </div>
    </div>
    <div class="options">
        <div>
            <label for="option">オプション①:</label>
            <input type="text" id="option1" name="option1" required>
            <label for="option">値段:</label>
            <input type="text" id="option1-price" name="option1-price" required>
        </div>
        <div>
            <label for="option">オプション②:</label>
            <input type="text" id="option2" name="option2" required>
            <label for="option">値段:</label>
            <input type="text" id="option2-price" name="option2-price" required>
        </div>
        <div>
            <label for="option">オプション③:</label>
            <input type="text" id="option3" name="option3" required>
            <label for="option">値段:</label>
            <input type="text" id="option3-price" name="option3-price" required>
        </div>
    </div>
    <button type="submit">更新</button>
</form>
