import { defineConfig } from 'vite';
import nette from '@nette/vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  server: {
    port: 5173,
	host: '0.0.0.0',
	strictPort: true
  },
  root: 'assets',
  plugins: [
    tailwindcss(),
    nette({ entry: ['main.tsx'] }),
  ],
});