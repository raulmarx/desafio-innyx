<template>
  <div class="container bg-white border rounded p-3 justify-content-center cards">
    <h3 class="m-1 mb-3">Produtos</h3>

    <div class="row">
      <div class="col-md-3 ">
        <div class="list-group">
          <button type="button" class="btn btn-success" style="border-bottom: solid;"
            @click="createCategoryProduct">Novo</button>
          <button type="button" class="list-group-item list-group-item-action" @click="filterByCategory()">Todos</button>
          <button v-for="category in categories.data" :key="category.id" type="button"
            class="list-group-item list-group-item-action" @click="filterByCategory(category.id)">{{
              category.name_category }}</button>
        </div>
      </div>
      <div class="col-md-9 ">

        <div v-if="!loading" class="row">
          <div class="col-md-4" v-for="product in products.data" :key="product.id" @click="editProduct(product.id)">
            <div class="card mb-4">
              <span class="remove-icon m-2 ">
                <button type="button" class="btn btn-danger" @click.stop="removeProduct(product.id)">
                  <span aria-hidden="true">
                    <i class="bi-trash"></i>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" @click.stop="editProduct(product.id)">
                  <span aria-hidden="true">
                    <i class="bi-pencil"></i>
                  </span>
                </button>
              </span>
              <img class="card-img-top" :src="getImageUrl(product.image)" alt="Imagem do Produto">
              <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <p class="card-text">{{ product.description }}</p>
                <p class="card-text">{{ product.price }}</p>
                <p class="card-text">{{ product.validate_date }}</p>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <div class="text-center">

            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import http from '../services/http.ts';
import router from '../router'


const products = ref([]);
const categories = ref([]);
const loading = ref(true);

const fetchProducts = async () => {
  try {
    const response = await http.get('/products');
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching users:', error);
  } finally {
    // Simulate a delay using setTimeout (remove this in your actual code)
    setTimeout(() => {
      loading.value = false;
    }, 2000); // Adjust the timeout as needed
  }
};

const fetchCategories = async () => {
  try {
    const response = await http.get('/categories');
    categories.value = response.data;
  } catch (error) {
    console.error('Error fetching users:', error);
  } finally {
    // Simulate a delay using setTimeout (remove this in your actual code)
    setTimeout(() => {
      loading.value = false;
    }, 2000); // Adjust the timeout as needed
  }
};

onMounted(fetchProducts);
onMounted(fetchCategories);

async function filterByCategory(id = null) {
  if (id) {
    products.value = await http.get(`/products/category/${id}`).then(res => res.data)
  } else {
    products.value = await http.get('/products').then(res => res.data)
  }

}
async function createCategoryProduct() {

  router.push({ name: 'create-update-category-product' });

}
async function editProduct(id: number) {

  router.push({ name: 'edit-product', params: { id: id } });
}

async function removeProduct(id: any) {
  try {
    await http.delete(`/products/${id}`)
    
  } catch (error) {
    console.error('Error fetching users:', error);
  } finally {
    setTimeout(() => {
      loading.value = false;
    }, 2000);
  }
}


function getImageUrl(imagePath: any) {
  return `http://localhost:8989/storage/${imagePath}`;
}
</script>

<style scoped>
/* Add your scoped styles here if needed */
.cards {
  padding: 2%;
  /* box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19); */
}
</style>