<template>
  <div class="container bg-white border rounded p-3 justify-content-center">
    <h3 class="m-1 mb-3">Usuarios</h3>
    <div class="m-1 mb-3">
      <label for="searchInput" class="form-label">Pesquisar:</label>
      <input type="text" id="searchInput" class="form-control"
        placeholder="Digite o termo de pesquisa" />
    </div>
    <table class="table table-striped table-bordered cards justify-content m-1 ">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody v-if="!loading">
        <tr v-for="user in users.data" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role[0] }}</td>
          <td class="text-center" >
            <button type="button" class="btn btn-success" @click="udpadePermissions(user.id)"><i class="bi-check"></i></button>
            <button type="button" class="btn btn-primary" @click="editUser(user.id)"> <i class="bi-pencil"></i></button>
            <button type="button" class="btn btn-danger" @click="deleteUser(user.id)"><i class="bi-trash"></i></button>
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td colspan="4" class="text-center">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import http from '../services/http.ts';
import router from '../router'

const users = ref([]);
const loading = ref(true);

const fetchUsers = async () => {
  try {
    const response = await http.get('/users');
    users.value = response.data;
  } catch (error) {
    console.error('Error fetching users:', error);
  } finally {
    // Simulate a delay using setTimeout (remove this in your actual code)
    setTimeout(() => {
      loading.value = false;
    }, 2000); // Adjust the timeout as needed
  }
};

onMounted(fetchUsers);

async function udpadePermissions(id:number){

  router.push({ name: 'update-permissions-roles', params: { id: id } });

}
async function editUser(id:number){

  
  router.push({ name: 'editar-user', params: { id: id } });
}
async function deleteUser(id:number){

  
  router.push({ name: 'delete-user', params: { id: 123 } });
}
</script>

<style scoped>
/* Add your scoped styles here if needed */
.cards {
  padding: 5%;
  box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
</style>