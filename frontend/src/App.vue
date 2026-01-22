<script setup lang="ts">
import { RouterView } from "vue-router";
import Header from './components/Header.vue'
</script>

<template>
  <div class="app-layout">
    <Header />
    <RouterView v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </RouterView>
  </div>
</template>