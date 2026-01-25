<script setup lang="ts">
import { RouterView } from "vue-router";
import Header from './components/Header.vue'
import { useAuthStore } from "./stores/auth";


const auth = useAuthStore();
</script>

<template>
  <div class="app-layout">
    <Header v-if="auth.isAuthenticated"/>
    <RouterView v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </RouterView>
  </div>
</template>