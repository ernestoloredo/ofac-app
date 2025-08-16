import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  server: {
    host: '0.0.0.0',        // listen on all interfaces
    port: 5173,
    strictPort: true,
    cors: true,              // enable CORS
    hmr: {
      host: '172.28.173.15', // the IP Laravel uses
      protocol: 'ws',
    },
  },
  plugins: [
    laravel({
      input: ['resources/js/app.js'],
      refresh: true,
    }),
    vue(),
  ],
});
