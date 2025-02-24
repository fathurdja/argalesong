import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/css/custom.css' ,'resources/js/app.js','resources/js/afiliasi.js','resources/js/bootstrap.js','resources/js/confirm.js','resources/js/form-edit.js','resources/js/jatuh-tempo.js','resources/js/navigasi.js','resources/js/pelanggan.js','resources/js/test.js'],
            refresh: true,
        }),
    ],
});
