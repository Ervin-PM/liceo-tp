/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './app/Http/Livewire/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        liceo: {
          azul: '#0D47A1',
          amarillo: '#FBC02D'
        }
      }
    }
  },
  plugins: []
}
