<template>
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">A dónde quieres ir?</h1>
        <form action="#" @submit.prevent="">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <AddressField />
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">
                        Buscar viaje
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import AddressField from '../components/AddressField.vue'
</script>