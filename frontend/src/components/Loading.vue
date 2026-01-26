  <template>
    <transition name="fade">
      <div v-if="visible" class="loading-overlay">
        <div class="loading-card">
          <div class="spinner"></div>
          <p class="loading-text">{{ text }}</p>
        </div>
      </div>
    </transition>
  </template>

  <script setup lang="ts">
  defineProps({
    visible: { type: Boolean, required: true },
    text: { type: String, default: 'Loading...' },
  });
  </script>
  
  <style scoped>
  .loading-overlay {
    position: fixed;
    inset: 0;
    background: rgba(47, 54, 64, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000;
  }
  
  .loading-card {
    background: #ffffff;
    padding: 1.5rem 2rem;
    border-radius: 8px;
    text-align: center;
    min-width: 200px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }
  
  .spinner {
    width: 36px;
    height: 36px;
    border: 4px solid #e1e1e1;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 0.9s linear infinite;
    margin: 0 auto 0.75rem;
  }
  
  .loading-text {
    font-size: 0.95rem;
    color: #333;
  }
  
  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
  </style>
  