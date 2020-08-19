import axios from 'axios';
import EventBus from './Event';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.EventBus = EventBus;
