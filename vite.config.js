import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js', 'resources/js/index.js', 'resources/js/login.js', 'resources/js/loginq.js', 'resources/js/products.js', 'resources/js/quiz.js', 'resources/js/test.js','resources/css/style.css','resources/css/products.css','resources/css/quiz.css','resources/css/login.css','resources/css/prsntst.css','resources/css/quiz.css','resources/css/testbegin.css','resources/css/layout.css'],
            refresh: true,
        }),
    ],
});
