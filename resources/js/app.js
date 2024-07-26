import './bootstrap';

import.meta.glob([
    '../images/**',
]);

import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

    document.getElementById('toggle-icon').addEventListener('click', function () {
    document.getElementById('menu-icon').classList.toggle('hidden');
    document.getElementById('close-icon').classList.toggle('hidden');
});

document.addEventListener('DOMContentLoaded', function () {
    const selectMenu = document.getElementById('Tab');
    const navItems = document.querySelectorAll('.nav-item');

    // Function to set the active navigation item
    function setActiveNavItem(value) {
        navItems.forEach(item => {
            item.classList.remove('border-sky-500', 'text-sky-600');
            item.classList.add('border-transparent', 'text-gray-500');
        });
        const activeNavItem = document.getElementById('nav-' + value);
        if (activeNavItem) {
            activeNavItem.classList.remove('border-transparent', 'text-gray-500');
            activeNavItem.classList.add('border-sky-500', 'text-sky-600');
        }
    }

    // Initial set based on the selected option
    setActiveNavItem(selectMenu.value);

    // Listen for changes on the select menu
    selectMenu.addEventListener('change', function () {
        setActiveNavItem(this.value);
    });
});

