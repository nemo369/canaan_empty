module.exports = {
  purge: ["./wp-content/themes/canaan/**/*.{vue,js,ts,jsx,tsx,php,svg}"],
  mode: "jit",
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        black: { DEFAULT: "#404040" },
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
