<template>
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4"> Ingrese su numero de telefono </h1>
        <form v-if="!waitingOnVerification" action="#" @submit.prevent="handleLogin">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" v-model="credentials.phone" name="phone" placeholder="506-61836301"     
                        class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" @submit.prevent="handleLogin"
                        class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">Continuar</button>
                </div>
            </div>
        </form>
        <form v-else action="#" @submit.prevent="handleVerification">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" v-model="credentials.login_code" name="login_code" id="login_code" placeholder="123456"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" @submit.prevent="handleVerification"
                        class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">Verify</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
//import { vMaska } from 'maska'
import { reactive, ref } from 'vue'
import axios from 'axios'

const credentials = reactive({
    phone: null
})

const waitingOnVerification = ref(false) //PROBLEMA

const getFormattedCredentials = () => {
    // Eliminar espacios, paréntesis y guiones del número de teléfono
    const phone = credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', '');
    return {
        phone: formattedPhone,
        login_code: credentials.login_code
    };
};

const handleLogin = () => {
    axios.post('http://127.0.0.1:8000/api/login', {
        phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', '')
    })
    //HACER METODO DE VALIDACION DEL NUMERO
    .then((response) => {
        console.log(response.data)
        waitingOnVerification.value = true
    })
    .catch((error) => {
        console.error(error)
        alert(error.response.data.message)
    })
}

const handleVerification = () => {
     axios.post('http://127.0.0.1:8000/api/login/verify', {
        phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', ''),
        login_code: credentials.login_code
     })
         .then((response) => {
         console.log(response.data) //auth
         })
        .catch((response) => {
        console.error(error)
        alert(error.response.data.message)
        })
}
</script>
