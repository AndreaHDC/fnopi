/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    extend: {
      colors: {
        'fnopi-background':'#FCFDF5',
        'fnopi-blue':'#B3C8CD',
        'fnopi-dark-blue':'#016976',
        'fnopi-dark-green':'#8AB185',
        'fnopi-gray':'#707070',
        'fnopi-green':'#A5BE3A',
        'fnopi-black':'#202A2C',
      }, // Extend Tailwind's default colors
      fontFamily: {
        'fnopi-body': ['"Lato"', 'sans-serif'],
        'fnopi-heading': ['"Bodoni"', 'serif'],
      },
    },
    colors: {
      black: '#000',
      white: '#fff',
    }
  },
  plugins: [],
};

export default config;
