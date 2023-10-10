import axios from "axios";
import store from "./store";

const axiosClient = axios.create({
  baseURL: 'http://localhost:8000/api'
});

// Get the CSRF token from the meta tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

axiosClient.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

axiosClient.defaults.withCredentials = true;

axiosClient.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${store.state.user.token}`;
  return config;
});

export default axiosClient;
