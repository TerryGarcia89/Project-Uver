<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50" v-if="show">
      <div class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
        <h2 class="text-2xl font-semibold mb-4">Viaje solicitado</h2>
        <p><strong>Destino:</strong> {{ destino }}</p>
        <p><strong>Precio:</strong> {{ precio }} colones</p>
        <div class="mt-4 flex justify-around">
          <button @click="aceptar" class="bg-green-500 text-white py-2 px-4 rounded">Aceptar</button>
          <button @click="rechazar" class="bg-red-500 text-white py-2 px-4 rounded">Rechazar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true
      },
      destino: {
        type: String,
        required: true
      },
      precio: {
        type: Number,
        required: true
      }
    },
    methods: {
      aceptar() {
        this.$emit('aceptar');
      },
      rechazar() {
        this.$emit('rechazar');
      }
    }
  }
  </script>
  
  <style scoped>
  /* Styles for the modal */
  </style>
  