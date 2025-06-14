import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/especies-form.js', 'resources/js/entradas-form.js', 'resources/js/confirmation-window.js', 'resources/js/login-validation.js', 'resources/js/registration-validation.js', 'resources/js/entradas-validation.js', 'resources/js/especies-validation.js', 'resources/js/especies-sug-validation.js', 'resources/js/mapa-create.js', 'resources/js/mapa-edit.js', 'resources/js/mapa-show.js', 'resources/js/stats.js', 'resources/js/usermod-validation.js'],
            refresh: true,
        }),
        tailwindcss()
    ],
});
