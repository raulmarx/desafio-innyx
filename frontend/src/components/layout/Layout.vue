<template>
    
    <RouterView />
</template>

<script setup lang="ts">
import { defineComponent, ref } from 'vue';
import router from '../../router'

const routePage = router.getRoutes()[0].name;
</script>

<style scoped></style>