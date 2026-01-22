<script setup lang="ts">
import { RouterView } from "vue-router";
</script>

<template>
  <div class="app-layout">
    <RouterView v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </RouterView>
  </div>
</template>