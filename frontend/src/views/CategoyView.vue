<template>
    <div class="modals">
          <h1>Modal</h1>
          <button type="button">Show</button>
          <div v-if="ShowModal" class="modal" >
                <h1>caraio</h1>
              <p>va pa puta que pariu</p>
              <button type="button">Hidde</button>
          </div>
      </div>
  </template>

<script setup lang="ts">

import { ref } from "vue";

const ShowModal = ref(true)

</script>

