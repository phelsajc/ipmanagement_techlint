<template>
  <div class="dashboard-wrapper">
    <div class="dashboard-header">
      <h1 class="title">IP Address Management</h1>
      <button class="btn btn-primary" @click="openAddIP">
        Add New IP
      </button>
    </div>

    <div class="card mt-4">
      <table class="ip-table">
        <thead>
          <tr>
            <th>IP Address</th>
            <th>Title</th>
            <th>Comment</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="ip in ips" :key="ip.id">
            <td>{{ ip.ip_address }}</td>
            <td>{{ ip.title }}</td>
            <td>{{ ip.comment || "-" }}</td>
            <td>
              <button
                v-if="auth.isAdmin || auth.user.id === ip.created_by"
                @click="editIp(ip)"
                class="btn btn-primary"
              >
                Edit
              </button>

              <button
                v-if="auth.isAdmin"
                class="btn btn-logout"
                @click="deleteIp(ip.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-if="showModal" class="modal-overlay">
      <div class="modal-card card">
        <h2 class="title">IP Management</h2>

        <form @submit.prevent="saveIP">
          <div class="form-group">
            <label>IP Address</label>
            <input v-model="data.ip_address" type="text" class="input-field" />
          </div>

          <div class="form-group">
            <label>Title</label>
            <input v-model="data.title" type="text" class="input-field" />
          </div>

          <div class="form-group">
            <label>Comment</label>
            <input v-model="data.comment" type="text" class="input-field" />
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-cancel" @click="closeModal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useAuthStore } from "../stores/auth";
import axios from "axios";

interface IPAddress {
  id: number;
  ip_address: string;
  title: string;
  comment: string;
  created_by: number;
}
const auth = useAuthStore();

const ips = ref<IPAddress[]>([]);
const showModal = ref(false);
const editingIP = ref(false);
const data = ref({ id: 0, ip_address: "", title: "", comment: "" });

const fetchIps = async () => {
  try {
    const res = await axios.get("http://localhost:8000/api/ips");
    ips.value = res.data;
  } catch (e) {
    console.error(e);
  }
};

const openAddIP = () => {
  editingIP.value = false;
  data.value = {
    id: 0,
    ip_address: '',
    title: '',
    comment: ''
  };
  showModal.value = true;
};

const editIp = (ip: IPAddress) => {
  editingIP.value = true;
  data.value = { ...ip };
  showModal.value = true;
};

const saveIP = async () => {
  try {
    if (editingIP.value) {
      await axios.put(`http://localhost:8000/api/ips/${data.value.id}`, {
        label: data.value.title,
        comment: data.value.comment,
        user_id: auth.user.id,
        role_id: auth.user.role,
      });
    } else {
      await axios.post("http://localhost:8000/api/ips", {
        ...data.value,
        user_id: auth.user.id,
      });
    }
    closeModal();
    fetchIps();
  } catch (e: any) {
    alert(e.response?.data?.error || "Operation failed");
  }
};

const deleteIp = async (id: number) => {
  if (!confirm("Delete selected IP Address?")) return;
  try {
    await axios.delete(`http://localhost:8000/api/ips/${id}`, {
      data: {
        user_id: auth.user.id,
        role_id: auth.user.role,
      },
    });
    fetchIps();
  } catch (e: any) {
    alert(e.response?.data?.error || "Delete failed");
  }
};

const closeModal = () => {
  showModal.value = false;
};

onMounted(fetchIps);
</script>

<style scoped>
.dashboard-wrapper {
  padding: 2rem;
}

.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.ip-table {
  width: 100%;
  border-collapse: collapse;
}

.ip-table th,
.ip-table td {
  padding: 0.75rem 1rem;
  border-bottom: 1px solid #dcdde1;
  text-align: left;
}

.ip-table th {
  background-color: #f0f0f0;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(47, 54, 64, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-card {
  width: 400px;
}
</style>
