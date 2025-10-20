import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const tokenEl = document.querySelector('meta[name="csrf-token"]');
if (tokenEl) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = tokenEl.getAttribute('content');
}
// Ensure cookies (XSRF-TOKEN) are sent when using Vite dev server
window.axios.defaults.withCredentials = true;
