const defaultTheme = require( 'tailwindcss/defaultTheme' );

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: [ 'Nunito', ...defaultTheme.fontFamily.sans ],
      },
    },
  },

  plugins: [ require( '@tailwindcss/forms' ), require( '@tailwindcss/typography' ) ],

  safelist: [
    'bg-purple-200', 'bg-purple-800',
    'text-purple-800', 'text-purple-300',
    'bg-blue-200', 'bg-blue-800',
    'text-blue-800', 'text-blue-300',
    'bg-yellow-200', 'bg-yellow-800',
    'text-yellow-800', 'text-yellow-300',
    'bg-red-200', 'bg-red-800',
    'text-red-800', 'text-red-300',
    'bg-green-200', 'bg-green-800',
    'text-green-800', 'text-green-300',
  ],
};
