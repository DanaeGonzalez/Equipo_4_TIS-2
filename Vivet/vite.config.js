import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss'; // Importa Tailwind

import flowbite from 'flowbite/plugin';

export default defineConfig({
  plugins: [
    [flowbite],
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  css: {
    postcss: {
      plugins: [
        tailwindcss(), // Añade Tailwind como plugin de PostCSS
      ],
    },
  },
});