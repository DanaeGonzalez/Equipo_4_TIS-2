import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import flowbite from 'flowbite/plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  css: {
    postcss: {
      plugins: [
        tailwindcss(),
        flowbite, // ✅ aquí va como plugin, no como array [flowbite]
      ],
    },
  },
});
