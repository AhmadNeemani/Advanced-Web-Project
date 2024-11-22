import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js', 'resources/js/index.js', 'resources/js/login.js', 'resources/js/loginq.js', 'resources/js/products.js', 'resources/js/quiz.js', 'resources/js/test.js'],
            refresh: true,
        }),
    ],
});
