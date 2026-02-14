import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#2563eb',   // blue-600
        secondary: '#64748b', // slate-500
        danger: '#dc2626',    // red-600
      }
    },
  },
  plugins: [],
}

