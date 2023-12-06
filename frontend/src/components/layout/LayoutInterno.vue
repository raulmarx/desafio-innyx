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
                </ul>
            </div>
        </nav>
    </header>
    <RouterView />
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>