import axios from 'axios';


const axiosInstance = axios.create({
    baseURL:'http://localhost:8989/',
    headers:{
        'Content-Type': 'multipart/form-data'
    }
});

axiosInstance.interceptors.request.use((config) => {
    // Obtendo o token do localStorage
    const token = localStorage.getItem('token');
  
    // Adicionando o token ao cabeçalho da requisição
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
  
    return config;
  });

export default axiosInstance;