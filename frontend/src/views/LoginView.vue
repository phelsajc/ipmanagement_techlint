<template>
  <div class="login-wrapper">
    <div class="card login-card">
      <h2 class="title">Welcome Back</h2>
      <p class="subtitle">Sign in to manage IP addresses</p>

      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label>Email</label>
          <input
            v-model="email"
            type="email"
            class="input-field"
            placeholder="Enter your email"
            required
          />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input
            v-model="password"
            type="password"
            class="input-field"
            placeholder="Enter password"
            required
          />
        </div>

        <button
          type="submit"
          class="btn btn-primary full-width"
        >
          Sign In
        </button>

      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useUiStore } from '../stores/ui'

const auth = useAuthStore();
const ui = useUiStore()

const email = ref("admin@example.com");
const password = ref("password");

const handleLogin = async () => {
  ui.showLoading()
  try {
    await auth.login({ email: email.value, password: password.value });
  } catch (e: any) {
    
  } finally {
    ui.hideLoading()
  }
};
</script>
