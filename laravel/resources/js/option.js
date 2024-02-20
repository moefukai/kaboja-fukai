document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    const optionContainer = document.getElementById('option-container');
    const addOptionButton = document.getElementById('add-option');

    addOptionButton.addEventListener('click', function() {
        console.log('Add option button clicked');
        const optionIndex = document.querySelectorAll('.option-section').length;
        let optionSection = document.createElement('div');
        optionSection.classList.add('option-section');
        optionSection.innerHTML = `
            <hr>
            <label>オプション名:</label>
            <input type="text" name="options[${optionIndex}][name]" required>
            <label>価格:</label>
            <input type="number" name="options[${optionIndex}][price]" required>
        `;

        const removeOptionButton = document.createElement('button');
        removeOptionButton.textContent = 'オプションを削除';
        removeOptionButton.type = 'button';
        removeOptionButton.classList.add('remove-option');
        removeOptionButton.addEventListener('click', function() {
            console.log('Remove option button clicked');
            optionSection.remove();
        });

        optionSection.appendChild(removeOptionButton);
        console.log('Remove option button added');

        optionContainer.appendChild(optionSection);
        console.log('Option section added to container');
    });
});

