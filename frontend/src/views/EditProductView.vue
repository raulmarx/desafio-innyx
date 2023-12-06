<template>
  <div class="container bg-white border rounded p-3 justify-content-center">
    <div class="m-3">
      <h2 class="mt-4">Editar Produto</h2>
      <form @submit.prevent="submitEditProductForm" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="productName" class="form-label">Nome do Produto:</label>
          <input v-model="productFormData.name" type="text" class="form-control" id="productName" required>
        </div>
        <div class="mb-3">
          <label for="productDescription" class="form-label">Descrição do Produto:</label>
          <input v-model="productFormData.description" type="text" class="form-control" id="productDescription" required>
        </div>
        <div class="mb-3">
          <label for="productCategory" class="form-label">Categoria do Produto:</label>
          <select v-model="productFormData.category_id" class="form-select" id="productCategory" required>
            <option value="" disabled>Selecione a categoria</option>
            <option v-for="category in categories.data" :key="category.id" :value="category.id">
              {{ category.name_category }}
            </option>
          </select>
        </div>
        <div class="custom-file mb-3">
          <label class="form-label" for="image">Imagem:</label>
          <input :on-change="productFormData.image" class="form-control" type="file" id="image"
            @change="handleImageUpload" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="price">Valor:</label>
          <div class="input-group">
            <span class="input-group-text">R$</span>
            <input v-model="productFormData.price" type="number" class="form-control" id="price" aria-label="Quantia">
          </div>
        </div>
        <div class="mb-3">
          <label for="productDate" class="form-label">Data de Validade do Produto:</label>
          <input v-model="productFormData.validate_date" type="date" class="form-control" id="productDate" required>
        </div>
        <div class="d-flex flex-row-reverse">
          <button type="submit" class="btn btn-success">Editar Produto</button>
        </div>
      </form>
    </div>
  </div>
</template>
  
<script setup lang="ts">
import { ref, onMounted, getCurrentInstance } from 'vue';
import http from '../services/http.ts';
import router from '@/router';
import axios from 'axios';

const productId = ref();
const instance = getCurrentInstance();
const loading = ref(true);
const categories = ref([]);
const imageFile = ref<File | null>(null);

const productFormData = ref({
  name: '',
  description: '',
  category_id: '',
  image: '',
  price: '',
  validate_date: '',
});

const handleImageUpload = (event: Event) => {
  const input = event.target as HTMLInputElement;
  const file = input.files?.[0];
  if (file) {
    imageFile.value = file;
  }
};

const fetchProducts = async () => {
  try {
    const response = await http.get(`/products/${productId.value}`);
    const productDataFromApi = response.data;

    console.log(productDataFromApi);

    // Set the initial values for the form fields
    productFormData.value = {
      name: productDataFromApi.products.name,
      description: productDataFromApi.products.description,
      category_id: productDataFromApi.products.category_id,
      image: productDataFromApi.products.image,
      price: productDataFromApi.products.price,
      validate_date: productDataFromApi.products.validate_date,
    };
    console.log(productFormData.value);
  } catch (error) {
    console.error('Error fetching product:', error);
  } finally {
    loading.value = false;
  }
};
const fetchCategories = async () => {
  try {
    const response = await http.get('/categories');
    categories.value = response.data;
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const submitEditProductForm = async () => {
  try {
    const formData = new FormData();
    formData.append("_method", 'PATCH');
    formData.append('name', productFormData.value.name);
    formData.append('description', productFormData.value.description);
    formData.append('category_id', productFormData.value.category_id);
    formData.append('price', productFormData.value.price);
    formData.append('image', imageFile.value as File);
    formData.append('validate_date', productFormData.value.validate_date);

    for (const entry of formData.entries()) {
      const [key, value] = entry;
      console.log(`${key}: ${value}`);
    }
    const token = localStorage.getItem('token');

    const response = await axios.post(`http://localhost:8989/products/${productId.value}`, formData,{headers: {
    'Content-Type': 'multipart/form-data',
    'Authorization': `Bearer ${token}`,
    // outros cabeçalhos, se necessário
  }})
      .then(response => {
        return response;
      })
      .catch(error => {
        console.log(error);
      });
    router.push('/category-product');

    return response.data;
  } catch (error) {
    if (error.response) {
      console.error('O servidor respondeu com o código de status', error.response.status);
      console.error('Dados da resposta:', error.response.data);
    } else {
      console.error('Erro ao enviar o formulário do produto:', error.message);
    }
    throw error;
  }
};

onMounted(async () => {
  productId.value = instance.proxy.$route.params.id;
});
onMounted(fetchProducts);
onMounted(fetchCategories);

</script>
  
<style scoped>
/* Estilos específicos do componente, se necessário */
</style>
  