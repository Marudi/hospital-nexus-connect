
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react-swc';
import { lovableTagger } from 'lovable-tagger';

export default defineConfig({
  plugins: [
    react(),
    lovableTagger()
  ],
  server: {
    port: 8080,
    open: true,
    allowedHosts: [
      'localhost', 
      '127.0.0.1', 
      '*.lovableproject.com'
    ],
  },
  build: {
    outDir: 'dist',
    sourcemap: true
  }
});
