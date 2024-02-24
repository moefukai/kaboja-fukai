document.addEventListener('DOMContentLoaded', function () {
    const tabElements = document.getElementsByName('tab-radio');
    tabElements.forEach(tabElement => {
        tabElement.addEventListener('click', function(){
            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.style.display = 'none';
            });
            document.querySelector('.' + this.value).style.display = 'block';

            tabElements.forEach(innerTabElement => {
                innerTabElement.nextElementSibling.classList.remove('selected');
            });
            this.nextElementSibling.classList.add('selected');
        });
    });
    document.querySelector('.' + tabElements[0].value).style.display = 'block';
    tabElements[0].nextElementSibling.classList.add('selected');
});
