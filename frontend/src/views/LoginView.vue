<template>
  <div class="container login-container">
    <div class="row">
      <div class="login-form-1">
        <h3>Login</h3>
        <form @submit.prevent="login">
          <div class="form-group">
            <input v-model="user.email" type="email" class="form-control inputs" placeholder="Your Email *" />
          </div>
          <div class="form-group">
            <input v-model="user.password" type="password" class="form-control inputs" placeholder="Your Password *" />
          </div>
          <div class="form-group">
            <input type="submit" class="btnSubmit" value="Login" />
          </div>
          <div class="form-group">
            <a href="#" class="ForgetPwd">Forget Password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import http from '../services/http.ts';
import { useAuthStore } from '../stores/auth.ts';
import router from '@/router';

const auth = useAuthStore();

const user = reactive({
  email: '',
  password: ''
})

async function login() {
  try {
    const { data } = await http.post('/login', user);
    auth.setToken(data.token);
    auth.setUser(data.user);
    router.push('/home')

  } catch (error) {
    console.error(error?.response?.data);
  }
}
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