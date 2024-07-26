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
