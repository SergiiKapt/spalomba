import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'http://eurolombard.ksask.net/api/',
});

export default axiosInstance;