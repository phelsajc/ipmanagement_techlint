<template>
  <div class="audit-wrapper">
    <div class="card mt-4">
      <h1 class="title">Audit Logs</h1>
      <table class="audit-table">
        <thead>
          <tr>
            <th>Time</th>
            <th>User</th>
            <th>Event</th>
            <th>Changes</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="log in logs" :key="log.id">
            <td>{{ new Date(log.created_at).toLocaleString() }}</td>
            <td>
              <span v-if="log.user">{{ log.user.name || log.user.email }}</span>
              <span v-else>{{ log.user_id }}</span>
            </td>
            <td>
              <span class="tag">{{ log.event }}</span>
            </td>
            <td class="code-cell">
              <div v-if="log.old_values">Old: {{ log.old_values }}</div>
              <div v-if="log.new_values">New: {{ log.new_values }}</div>
              <div v-if="log.details">Details: {{ log.details }}</div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "../stores/auth";
import { useUiStore } from '../stores/ui'

const logs = ref<any[]>([]);
const auth = useAuthStore();
const ui = useUiStore()

const fetchLogs = async () => {
  ui.showLoading('Fetching logs...');
  try {
    const [resIp, resAuth] = await Promise.all([
      axios.get("http://localhost:8000/api/audit-logs", {
        params: { user_id: auth.user.id, role: auth.user.role },
      }),
      axios.get("http://localhost:8000/api/auth/audit-logs", {
        params: { user_id: auth.user.id, role: auth.user.role },
      })
    ]);

    const ipLogs = resIp.data.map((log: any) => ({ ...log, source: 'ip' }));
    const authLogs = resAuth.data.map((log: any) => ({ ...log, source: 'auth' }));
    const combinedLogs = [...ipLogs, ...authLogs];
    
    logs.value = combinedLogs;
  } catch (e) {
    console.error(e);
  } finally {
    ui.hideLoading();
  }
};

onMounted(fetchLogs);
</script>

<style scoped>
.audit-wrapper {
  padding: 2rem;
}

.audit-table {
  width: 100%;
  border-collapse: collapse;
}

.audit-table th,
.audit-table td {
  padding: 0.75rem 1rem;
  border-bottom: 1px solid #dcdde1;
  text-align: left;
}

.audit-table th {
  background-color: #f0f0f0;
}
</style>
