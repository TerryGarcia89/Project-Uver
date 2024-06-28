<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h1 class="text-3xl font-semibold mb-4 text-center text-gray-800">Uver App</h1>
  
        <div class="flex justify-between">
          <button @click="handleStartDriving"
            class="w-1/2 bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-md shadow-sm focus:outline-none">
            Conducir
          </button>
          <button @click="handleFindARide"
            class="w-1/2 bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-md shadow-sm focus:outline-none">
            Buscar viaje
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useRouter } from 'vue-router';
  import http from '@/helpers/http';
  
  const router = useRouter();
  
  const handleStartDriving = () => {
    http().get('/api/driver')
      .then((response) => {
        if (response.data.driver) {
          router.push({ name: 'standby' });
        } else {
          router.push({ name: 'driver' });
        }
      })
      .catch((error) => {
        console.error(error);
      });
  };
  
  const handleFindARide = () => {
    router.push({ name: 'location' });
  };
  </script>
  
  <style>
  /* You can remove this style block if you're using Tailwind CSS for styling */
  </style>
  