<script>
import axios from 'axios'

export default {
  name: 'LoginForm',
  data() {
    return {
      email: '',
      password: '',
      remember: false,
      isLoading: false,
      errorMessage: '',
      successMessage: '',
      API_URL: 'http://localhost:3000'
    }
  },
  methods: {
    async handleLogin() {
      try {
        // Reset messages
        this.errorMessage = ''
        this.successMessage = ''
        this.isLoading = true

        // Validation
        if (!this.email || !this.password) {
          this.errorMessage = 'Email and password are required'
          return
        }

        // Login request
        const response = await axios.post(`${this.API_URL}/login`, {
          email: this.email,
          password: this.password
        })

        // Success
        this.successMessage = 'Login successful!'
        
        // Store token and user info
        const { accessToken, user } = response.data
        
        // Save to localStorage if remember me is checked
        if (this.remember) {
          localStorage.setItem('accessToken', accessToken)
          localStorage.setItem('user', JSON.stringify(user))
        } else {
          sessionStorage.setItem('accessToken', accessToken)
          sessionStorage.setItem('user', JSON.stringify(user))
        }

        // Redirect after 1 second
        setTimeout(() => {
          console.log('Login successful:', user)
          // Redirect logic here
          // this.$router.push('/dashboard')
          
        }, 1000)
        this.goToHome()
      } catch (error) {
        console.error('Login error:', error)
        
        if (error.response) {
          this.errorMessage = error.response.data.message || 'Login failed'
        } else if (error.request) {
          this.errorMessage = 'Cannot connect to server'
        } else {
          this.errorMessage = 'An error occurred'
        }
      } finally {
        this.isLoading = false
      }
    },
    goToHome(){
        this.$router.push('/')
    },
    goToRegister() {
      console.log('Redirect to register')
      // Router navigation
      // this.$router.push('/register')
    },

    forgotPassword() {
      console.log('Forgot password clicked')
      // Implement forgot password logic
    }
  }
}
</script>

<template>
  <section class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <!-- Logo -->
      <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <img class="w-8 h-8 mr-2" src="/images/Background.png" alt="logo">
        Group 2 Website    
      </div>

      <!-- Login Card -->
      <div class="w-full bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign in to your account
          </h1>

          <!-- Success Alert -->
          <div v-if="successMessage" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            {{ successMessage }}
          </div>

          <!-- Error Alert -->
          <div v-if="errorMessage" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            {{ errorMessage }}
          </div>

          <!-- Login Form -->
          <form class="space-y-4 md:space-y-6" @submit.prevent="handleLogin">
            <!-- Email Field -->
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Your email
              </label>
              <input 
                v-model="email"
                type="email" 
                name="email" 
                id="email" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-colors duration-200" 
                placeholder="name@company.com" 
                required
                :disabled="isLoading"
                :class="{ 'opacity-50 cursor-not-allowed': isLoading }"
              >
            </div>

            <!-- Password Field -->
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Password
              </label>
              <input 
                v-model="password"
                type="password" 
                name="password" 
                id="password" 
                placeholder="••••••••" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-colors duration-200" 
                required
                :disabled="isLoading"
                :class="{ 'opacity-50 cursor-not-allowed': isLoading }"
              >
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input 
                    v-model="remember"
                    id="remember" 
                    aria-describedby="remember" 
                    type="checkbox" 
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                    :disabled="isLoading"
                  >
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                </div>
              </div>
              <a 
                href="#" 
                @click.prevent="forgotPassword"
                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500 hover:text-blue-800 transition-colors duration-200"
                :class="{ 'pointer-events-none opacity-50': isLoading }"
              >
                Forgot password?
              </a>
            </div>

            <!-- Submit Button -->
            <button 
              type="submit" 
              class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]"
              :disabled="isLoading"
            >
              <div v-if="isLoading" class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Signing in...
              </div>
              <span v-else>Sign in</span>
            </button>

            <!-- Register Link -->
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
              Don't have an account yet? 
              <a 
                href="#" 
                @click.prevent="goToRegister"
                class="font-medium text-blue-600 hover:underline dark:text-blue-500 hover:text-blue-800 transition-colors duration-200"
                :class="{ 'pointer-events-none opacity-50': isLoading }"
              >
                Sign up
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Additional custom styles if needed */
.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>