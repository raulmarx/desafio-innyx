<template>
  <div class="container login-container center">
    <div class="row">
      <div class="login-form-1">
        <form @submit.prevent="editUser">
          <div class="form-group">
            <input v-model="user.name" type="text" class="form-control inputs" placeholder="Your Name *" />
          </div>
          <div class="form-group">
            <input v-model="user.email" type="email" class="form-control inputs" placeholder="Your Email *" />
          </div>
          <div class="form-group">
            <input v-model="user.password" type="password" class="form-control inputs" placeholder="Your Password *" />
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success w-100 mb-1 mt-2" value="Atualizar" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, getCurrentInstance, ref, onMounted } from 'vue';
import http from '../services/http.ts';
import router from '@/router';

const instance = getCurrentInstance();
const userId = ref()
onMounted(async () => {
  userId.value = instance.proxy.$route.params.id;
});

const user = ref({
  name: '',
  email: '',
  password: ''
})

async function dataUser() {
  try {
    const response = await http.get(`/users/${userId.value}`);
    const userData = response.data
    console.log(userData);
    user.value = {
      name: userData.data.name,
      email: userData.data.email,
      password: ''
    }

  } catch (error) {
    console.error(error?.response?.data);
  }
}
const editUser = async () => {
  try {
    const formData = new FormData();
    formData.append("_method", 'PATCH');
    formData.append('name', user.value.name);
    formData.append('email', user.value.email);
    formData.append('password', user.value.password);

    const response = await http.post(`/users/${userId.value}`, formData)
      .then(response => {
        return response;
      })
      .catch(error => {
        console.log(error);
      });
    router.push('/home');

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
onMounted(dataUser)
</script>

<style scoped>
.login-container {
  margin-top: 5%;
  margin-bottom: 5%;
}

.inputs {
  margin-top: 1%;
}

.login-form-1 {
  padding: 5%;
  box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}

.login-form-1 h3 {
  text-align: center;
  color: #333;
}

.login-container form {
  padding: 5%;
}

.btnSubmit {
  width: 50%;
  border-radius: 1rem;
  padding: 1.5%;
  border: none;
  cursor: pointer;
}

.login-form-1 .btnSubmit {
  font-weight: 600;
  color: #fff;
  background-color: #0062cc;
  margin-top: 2%;

}

.login-form-1 .ForgetPwd {
  color: #0062cc;
  font-weight: 600;
  text-decoration: none;
}
</style>