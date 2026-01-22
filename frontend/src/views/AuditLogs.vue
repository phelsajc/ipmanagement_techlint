<template>
  <div class="audit-wrapper">
    <h1 class="title">Audit Logs</h1>

    <div class="card mt-4">
      <table class="audit-table">
        <thead>
          <tr>
            <th>Time</th>
            <th>User</th>
            <th>Event</th>
            <th>Changes</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">


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
