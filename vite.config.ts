
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react-swc';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    port: 8080,
    open: true,
    allowedHosts: [
      'localhost', 
      '127.0.0.1', 
      '33ad2600-3c38-47c2-9fe1-35cd06161532.lovableproject.com'
    ],
  },
  build: {
    outDir: 'dist',
    sourcemap: true,
  },
  // Use esbuild to handle TypeScript instead of relying on tsconfig.json modifications
  esbuild: {
    // Enable JSX in .tsx files
    jsx: 'automatic',
    // Additional esbuild options if needed
  }
});
