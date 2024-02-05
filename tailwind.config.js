/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/**/*.{css,js}", "./src/*.php"],
  theme: {
    extend: {
      colors: {
        discord: {
          100: "#313338",
          200: "#232428",
          300: "#111214",
        },
        discordBtn: {
          100: "#248046",
          200: "#1a6334",
        },
        discordLink: "#00a8fc",
      },
      fontFamily: {
        ggsans: ["gg sans", "Noto Sans"],
      },
    },
  },
  plugins: [],
};
