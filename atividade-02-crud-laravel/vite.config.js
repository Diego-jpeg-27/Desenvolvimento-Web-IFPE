import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            //add TODOS os arquivos CSS/JS que serão usados pelo Vite
            input: [
                'resources/css/app.css',
                'resources/js/app.js',    
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});