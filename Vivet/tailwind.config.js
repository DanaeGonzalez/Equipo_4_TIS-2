/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php", // Archivos Blade
    "./resources/**/*.js",       // Archivos JavaScript
    "./resources/**/*.vue",      // Archivos Vue (si los usas)
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}