<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h1 class="text-3xl font-semibold mb-4 text-center text-gray-800">Esperando un Viaje</h1>
  
        <div class="mt-8 flex justify-center">
          <Loader />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import Loader from '@/components/Loader.vue';
  </script>
  
  <style>
  /* You can remove this style block if you're using Tailwind CSS for styling */
  
  .app-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f9fafb; /* Fallback for gradients */
    background-image: linear-gradient(to right, #9c27b0, #e91e63);
  }
  
  .loader {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top-color: #ffffff;
    animation: spin 1s ease-in-out infinite;
  }
  
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  </style>
  