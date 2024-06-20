/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
  theme: {
    extend: {
        colors:{
            'primary': '#5E7CE2',
            'secondary': '#92B4F4',
            'tertiary': '#CFDEE7',
        }
    },
  },
  plugins: [],
}

