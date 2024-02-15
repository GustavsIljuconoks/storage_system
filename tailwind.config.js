/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}",
        "node_modules/flowbite/**/*.{js,jsx,ts,tsx}"
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    "50":"#FFFFFF","100":"#FFFFFF","200":"#FFFFFF","300":"#FFFFFF","400":"#FEF4E3","500":"#FCE4BB","600":"#FBD594","700":"#F9C56D","800":"#F7B546","900":"#F6A61F","950":"#F59E0B"
                }
            },
            fontFamily: {
                'body': [
              'Inter', 
              'ui-sans-serif', 
              'system-ui', 
              '-apple-system', 
              'system-ui', 
              'Segoe UI', 
              'Roboto', 
              'Helvetica Neue', 
              'Arial', 
              'Noto Sans', 
              'sans-serif', 
              'Apple Color Emoji', 
              'Segoe UI Emoji', 
              'Segoe UI Symbol', 
              'Noto Color Emoji'
            ],
                'sans': [
              'Inter', 
              'ui-sans-serif', 
              'system-ui', 
              '-apple-system', 
              'system-ui', 
              'Segoe UI', 
              'Roboto', 
              'Helvetica Neue', 
              'Arial', 
              'Noto Sans', 
              'sans-serif', 
              'Apple Color Emoji', 
              'Segoe UI Emoji', 
              'Segoe UI Symbol', 
              'Noto Color Emoji'
            ]
              }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
