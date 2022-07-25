/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,ts}",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#3b7977',
        'secondary': '#57a99a',
      },
      height: {
        '128': '20rem',
        'half': '50vh',
        '3/4': '75vh'
      },
    },
  },
  plugins: [],
}
