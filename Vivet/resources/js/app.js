import './bootstrap';
import 'flowbite'; // Esto activa la auto-inicialización del carrusel
import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;
import { createIcons } from 'lucide';

var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});

document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
    button.addEventListener('click', () => {
        const targetId = button.getAttribute('data-collapse-toggle');
        const target = document.getElementById(targetId);

        // Cierra todos los demás dropdowns
        document.querySelectorAll('ul[id^="dropdown-"]').forEach(drop => {
            if (drop !== target) {
                drop.classList.add('hidden');
            }
        });

        // Alterna el dropdown actual
        target.classList.toggle('hidden');
    });
});
