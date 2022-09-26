import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/assets/css/vertical-layout-light/style.css',
                'resources/js/assets/vendors/css/vendor.bundle.base.css',
                'resources/js/assets/vendors/feather/feather.css',

                'resources/js/app.js',

                'resources/js/assets/js/template.js',
                'resources/js/assets/js/off-canvas.js',
                'resources/js/assets/js/vendor.bundle.base.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': '/resources/js',
        },
    },
});
