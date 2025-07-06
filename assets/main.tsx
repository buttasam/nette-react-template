import './style.css'
import { createRoot } from 'react-dom/client';
import NotesForm from './components/NotesForm';

const container = document.querySelector('[data-react-component="like-button"]');
if (container) {
  createRoot(container).render(<NotesForm />);
}