document.addEventListener('DOMContentLoaded', function () {
    updateOptionSelections();
    document.getElementById('total_number').addEventListener('change', updateOptionSelections);
});

function updateOptionSelections() {
    const totalNumber = parseInt(document.getElementById('total_number').value);
    const optionContainer = document.getElementById('optionContainer');
    optionContainer.innerHTML = '';

    for (let i = 0; i < totalNumber; i++) {
        const optionTemplate = document.getElementById('optionTemplate').content.cloneNode(true);
        const label = optionTemplate.querySelector('.option-label');
        label.textContent = `オプション選択 (${i + 1}個目):`;

        const checkboxesContainer = optionTemplate.querySelector('.checkboxes');
        options.forEach(option => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = `options[${i}][]`;
            checkbox.value = option.id;

            const label = document.createElement('label');
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(` ${option.name} (${Math.round(option.price)}円)`));

            checkboxesContainer.appendChild(label);
            checkboxesContainer.appendChild(document.createElement('br'));
        });

        optionContainer.appendChild(optionTemplate);
    }
}
