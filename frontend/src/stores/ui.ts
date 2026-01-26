import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUiStore = defineStore('ui', () => {
  const loading = ref(false);
  const loadingText = ref('Loading...');

  const showLoading = (text = 'Loading...') => {
    loadingText.value = text;
    loading.value = true;
  };

  const hideLoading = () => {
    loading.value = false;
  };

  return { loading, loadingText, showLoading, hideLoading };
});
