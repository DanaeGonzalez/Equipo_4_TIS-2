/** @type {import('tailwindcss').Config} */

const flowbitePlugin = require('flowbite/plugin');

module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php", // Archivos Blade
    './node_modules/flowbite/**/*.js',
    "./resources/**/*.js",       // Archivos JavaScript
    "./resources/**/*.vue",      // Archivos Vue (si los usas)
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require("daisyui"),
    flowbitePlugin
  ],
}