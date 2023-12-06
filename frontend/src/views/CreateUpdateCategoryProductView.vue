<template>
    <div class="container bg-white border rounded p-3 justify-content-center">


        <div class="m-3">
            <h2>Cadastro de Categoria</h2>
            <form @submit.prevent="submitCategoryForm">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Nome da Categoria:</label>
                    <input v-model="categoryFormData.name_category" type="text" class="form-control" id="categoryName"
                        required>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-success">Cadastrar Categoria</button>
                </div>
            </form>


            <h2 class="mt-4">Cadastro de Produto</h2>
            <form @submit.prevent="submitProductForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="productName" class="form-label">Nome do Produto:</label>
                    <input v-model="productFormData.name" type="text" class="form-control" id="productName" required>
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Descrição do Produto:</label>
                    <input v-model="productFormData.description" type="text" class="form-control" id="productDescription"
                        required>
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Categoria do Produto:</label>
                    <select v-model="productFormData.category_id" class="form-select" id="productCategory" required>
                        <option value="" disabled>Selecione a categoria</option>
                        <option v-for="category in categories.data" :key="category.id" :value="category.id">{{
                            category.name_category }}
                        </option>
                    </select>
                </div>
                <div class="custom-file mb-3">
                    <label class="form-label" for="image">Imagem:</label>
                    <input class="form-control" type="file" id="image" @change="handleImageUpload" />
                </div>
                <label class="form-label" for="image">Valor:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input v-model="productFormData.price" type="text" class="form-control" aria-label="Quantia">
                </div>
                <div class="mb-3">
                    <label for="productDate" class="form-label">Data de Validade do Produto:</label>
                    <input v-model="productFormData.validate_date" type="date" class="form-control" id="productDate"
                        required>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-success">Cadastrar Produto</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
  <!-- The rest of your script and style sections remain unchanged -->
  
  
<script setup lang="ts">
import { ref, onMounted } from 'vue';
import http from '../services/http.ts';
import router from '@/router';

const categoryFormData = ref({
    name_category: '',
});

const imageFile = ref<File | null>(null);
const handleImageUpload = (event: Event) => {
    const input = event.target as HTMLInputElement;
    const file = input.files?.[0];
    if (file) {
        imageFile.value = file;
    }
};

const productFormData = ref({
    name: '',
    description: '',
    category_id: '',
    price: '',
    validate_date: '',
});


const categories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await http.get('/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

onMounted(fetchCategories);


const submitCategoryForm = async () => {
    try {
        const response = await http.post('/categories', categoryFormData.value);
        if (response.data) {
            await fetchCategories();
            categoryFormData.value.name_category = '';
        }
        return response.data;
    } catch (error) {
        console.error('Error posting category:', error);
        throw error;
    }
};

const submitProductForm = async () => {
    try {

        // Criar um objeto FormData para lidar com o envio de dados multipart/form-data
        const formData = new FormData();
        // Adicionar os campos do formulário ao objeto FormData
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', productFormData.value.name);
        formData.append('description', productFormData.value.description);
        formData.append('category_id', productFormData.value.category_id);
        formData.append('price', productFormData.value.price);
        formData.append('image', imageFile.value as File);
        formData.append('validate_date', productFormData.value.validate_date);

        const response = await http.post('/products', formData);
        router.push('/category-product')
        return response.data;
    } catch (error) {
        console.error('Error posting product:', error);
        throw error;
    }
};
</script>
  
<style scoped>
/* Estilos específicos do componente, se necessário */
</style>