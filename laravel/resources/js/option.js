document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    const optionContainer = document.getElementById('option-container');
    const addOptionButton = document.getElementById('add-option');

    addOptionButton.addEventListener('click', function() {
        console.log('Add option button clicked');
        const optionIndex = document.querySelectorAll('.option-section').length;
        let optionSection = document.createElement('div');
        optionSection.classList.add('option-section', 'mt-4');

        const optionNameSection = document.createElement('div');
        optionNameSection.classList.add('flex', 'items-center', 'mt-2');
        optionNameSection.innerHTML = `
            <input type="text" name="options[${optionIndex}][name]" required class="peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="オプション名を入力">
            <button class="remove-option text-gray-400 hover:text-gray-600 ml-2" type="button">&times;</button>
        `;
        optionSection.appendChild(optionNameSection);

        const optionPriceSection = document.createElement('div');
        optionPriceSection.classList.add('flex', 'items-center', 'mt-2');
        optionPriceSection.innerHTML = `
            <input type="number" name="options[${optionIndex}][price]" required class="peer flex-grow border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="価格を入力">
            <button class="remove-option text-gray-400 hover:text-gray-600 ml-2" type="button">&times;</button>
        `;
        optionSection.appendChild(optionPriceSection);

        const removeButtons = optionSection.querySelectorAll('.remove-option');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Remove option button clicked');
                optionSection.remove();
            });
        });

        console.log('Remove option button added');
        optionContainer.appendChild(optionSection);
        console.log('Option section added to container');
    });
});
