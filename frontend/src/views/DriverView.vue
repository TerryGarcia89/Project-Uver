<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h1 class="text-3xl font-semibold mb-4 text-center text-gray-800">Driver and Car Details</h1>
  
        <form @submit.prevent="handleSaveDriver">
          <div class="overflow-hidden shadow sm:rounded-md text-left">
            <div class="bg-white px-4 py-5 sm:p-6">
              <div class="mt-2">
                <input type="text" name="name" v-model="driverDetails.name" placeholder="Full Name"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
              <div class="mt-2">
                <input type="number" name="year" v-model="driverDetails.year" placeholder="Car Year"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
              <div class="mt-2">
                <input type="text" name="make" v-model="driverDetails.make" placeholder="Make"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
              <div class="mt-2">
                <input type="text" name="model" v-model="driverDetails.model" placeholder="Model"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
              <div class="mt-2">
                <input type="text" name="color" v-model="driverDetails.color" placeholder="Color"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
              <div class="mt-2">
                <input type="text" name="license_plate" v-model="driverDetails.license_plate" placeholder="License Plate #"
                  class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                  required>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">Continue</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { reactive } from 'vue';
  import http from '@/helpers/http';
  import router from '../router';
  
  const driverDetails = reactive({
    name: '',
    year: null,
    make: '',
    model: '',
    color: '',
    license_plate: ''
  });
  
  const handleSaveDriver = () => {
    http().post('/api/driver', driverDetails)
      .then((response) => {
        router.push({ name: 'standby' });
      })
      .catch((error) => {
        console.error(error);
      });
  };
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
  </style>
  