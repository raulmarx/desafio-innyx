<template>
    <header>
        <nav class="nav navbar navbar-expand-lg navbar-light bg-light justify-content-center w-100">
            <div >
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'home' }" class="nav-link" aria-current="page">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'category-product' }" class="nav-link"> Produtos </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'about' }" class="nav-link"> Sobre</router-link>
                    </li>                    
                    <li class="nav-item">
                        <button class="nav-link" @click="logout">Sair</button>
                        
                    </li>                    
                </ul>
            </div>
        </nav>
    </header>
    <RouterView />
</template>

<script setup lang="ts">
import http from '../../services/http';
import router from '@/router';

async function logout(){
    await http.post('/logout')
    router.push('/login')
}
</script>

<style scoped>

</style>