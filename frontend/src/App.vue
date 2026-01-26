<script setup lang="ts">
import { RouterView } from "vue-router";
import Header from './components/Header.vue'
import { useAuthStore } from "./stores/auth";
import Loading from './components/Loading.vue';
import { useUiStore  } from './stores/ui'

const auth = useAuthStore();
const ui = useUiStore();
</script>

<template>
  <div class="app-layout">
    <Header v-if="auth.isAuthenticated"/>
    <Loading :visible="ui.loading" :text="ui.loadingText" />
    <RouterView v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </RouterView>
  </div>
</template>