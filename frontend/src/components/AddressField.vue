<template>
    <div class="mb-4">
        <input
            type="search"
            class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Buscar ubicación..."
            aria-label="Search"
            aria-describedby="button-addon2"
            ref="addressInput"
        >
    </div>
</template>


<script>
import { onMounted, ref } from 'vue';
import googlePlaces from '../composables/googlePlaces';
export default {
    setup() {
        const addressInput = ref(null);
        const link = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCAqdwRPpTtDGc6lWZKlSO0EPgkAKRo-8o&libraries=places";

        onMounted( async () => {
            await googlePlaces(link);
            new google.maps.places.Autocomplete(addressInput.value);
        })

        return {
            addressInput
        }
    }
}
</script>