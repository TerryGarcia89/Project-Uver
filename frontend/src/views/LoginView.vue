<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-md w-full">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Ingrese su número de teléfono</h1>
  
        <form v-if="!waitingOnVerification" @submit.prevent="handleLogin">
          <div class="mb-4">
            <input type="text" v-model="credentials.phone" name="phone" placeholder="50661836301"
              class="w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:outline-none focus:border-purple-500">
          </div>
  
          <div class="flex justify-end">
            <button type="submit"
              class="px-4 py-2 bg-purple-500 text-white rounded-md shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
              Continuar
            </button>
          </div>
        </form>
  
        <form v-else @submit.prevent="handleVerification">
          <div class="mb-4">
            <input type="text" v-model="credentials.login_code" name="login_code" id="login_code" placeholder="123456"
              class="w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:outline-none focus:border-purple-500">
          </div>
  
          <div class="flex justify-end">
            <button type="submit"
              class="px-4 py-2 bg-purple-500 text-white rounded-md shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
              Verify
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  const credentials = reactive({
    phone: null,
    login_code: null,
  });
  
  const waitingOnVerification = ref(false);
  
  const handleLogin = () => {
    axios.post('http://127.0.0.1:8000/api/login', {
      phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', ''),
    })
    .then((response) => {
      console.log(response.data);
      waitingOnVerification.value = true;
    })
    .catch((error) => {
      console.error(error);
      alert(error.response.data.message);
    });
  };
  
  const handleVerification = () => {
    axios.post('http://127.0.0.1:8000/api/login/verify', {
      phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', ''),
      login_code: credentials.login_code,
    })
    .then((response) => {
      console.log(response.data); // auth
      localStorage.setItem('token', response.data);
      router.push({ name: 'landing' });
    })
    .catch((error) => {
      console.error(error);
      alert(error.response.data.message);
    });
  };
  </script>
  
  <style>
  /* You can add custom styles here if needed */
  </style>
  