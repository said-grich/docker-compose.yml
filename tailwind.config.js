const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
<<<<<<< HEAD

=======
    
>>>>>>> 8ac8ae19ae04ea9023e5f84fdc72b9789373c49e
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],


};
