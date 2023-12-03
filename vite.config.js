import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/zabuto_calendar.min.css',
                'resources/js/zabuto_calendar.min.js',
            ],
            refresh: true,
        }),
    ],
});
