import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/animate.js',
                'resources/js/dropdown.js',
                'resources/js/lottie-player.js',
                'resources/js/mdb.js'
            ],
            refresh: true,
        })
    ],

});
