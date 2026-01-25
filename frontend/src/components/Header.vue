<template>
  <header class="app-header card">
    <nav class="nav-container">
      <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
      <router-link to="/audit-logs" class="nav-link">Audit Logs</router-link>
      <button class="btn btn-primary btn-logout" @click="logout">Logout</button>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { useAuthStore } from "../stores/auth";

const auth = useAuthStore();

const logout = () => {
  auth.logout();
}
</script>

<style scoped>
.app-header {
  padding: 1rem 2rem;
  background-color: #166881;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-container {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.nav-link {
  color: #fff;
  font-weight: 500;
  text-decoration: none;
}

.nav-link:hover {
  text-decoration: underline;
}

.btn-logout {
  background-color: #e84118;
  color: white;
  padding: 0.4rem 0.8rem;
  border-radius: 4px;
}

.btn-logout:hover {
  background-color: #c23616;
}
</style>
