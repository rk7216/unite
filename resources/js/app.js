import './bootstrap';

<<<<<<< Updated upstream
// public/js/app.js
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.item-select').forEach(select => {
        select.addEventListener('change', function() {
            const selectedItem = this.options[this.selectedIndex];
            updatePokemonStats(selectedItem);
        });
    });
});

function updatePokemonStats(selectedItem) {
    document.querySelectorAll('[data-stat]').forEach(cell => {
        const statType = cell.getAttribute('data-stat');
        const addValue = selectedItem.getAttribute(`data-${statType}`) ? parseInt(selectedItem.getAttribute(`data-${statType}`), 10) : 0;
        if (addValue !== 0) { // 加算値が0でない場合のみ更新を行う
            const originalValue = parseInt(cell.textContent, 10);
            const newValue = originalValue + addValue;
            cell.textContent = newValue; // 新しい値でセルのテキストを更新
        }
    });
}
=======
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
>>>>>>> Stashed changes
