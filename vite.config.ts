
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react-swc';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    port: 3000,
    open: true,
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
