import App from "./app";
import { createRoot } from 'react-dom/client';

const div = document.querySelector('#app');
const root = createRoot(div);
root.render(<App />);