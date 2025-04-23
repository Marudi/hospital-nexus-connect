
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
	  '33ad2600-3c38-47c2-9fe1-35cd06161532.lovableproject.com'
    ],
  },
  build: {
    outDir: 'dist',
    sourcemap: true
  }
});
