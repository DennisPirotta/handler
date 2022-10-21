import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/addon.js',
                'resources/js/lottie-player.js',
                'resources/js/lottie-web.js',
                'resources/js/mdb.js'
            ],
            refresh: true,
        })
    ],

});
