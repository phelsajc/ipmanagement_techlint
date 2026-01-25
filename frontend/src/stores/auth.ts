import { defineStore } from 'pinia'
import axios from 'axios'
import router from '../router'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') || '',
    user: JSON.parse(localStorage.getItem('user') || 'null'),
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
    isAdmin: (state) => state.user?.role === 1 // Assuming 1 is Admin
  },
  actions: {
    async login(credentials: any) {
      try {
        const response = await axios.post('http://localhost:8000/api/auth/login', credentials)
        this.token = response.data.access_token
        this.user = response.data.user
        
        localStorage.setItem('token', this.token)
        localStorage.setItem('user', JSON.stringify(this.user))
        
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        
        router.push('/')
      } catch (error) {
        throw error
      }
    },
    logout() {
      
    }
  }
})
