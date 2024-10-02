import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/game.scss',
                'resources/sass/index.scss',
                'resources/sass/create.scss',
                'resources/js/create.js',
                'resources/js/index.js',
                'resources/js/app.js',
                'resources/js/game.js',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
    ],
});
