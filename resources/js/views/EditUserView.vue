<style>
    .show {
        display: block;
    }
</style>

<template>
    <section class=" dark:bg-gray-500 mt-4">
        <div class="flex flex-col items-center justify-center mx-auto lg:py-0">
            <div class="w-full bg-blue-200 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    <div v-if="error" :class="{ 'show': showError, 'hide': showError == false }" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert" >
                        <span class="font-medium">{{ error }}</span>
                    </div>

                    <div v-if="success" :class="{ 'show': showSuccess, 'hide': !showSuccess }" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <span class="font-medium">{{ success }}</span>
                    </div>

                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Edit "{{ user.name }}"
                    </h1>
                    <div>
                        <label for="id" class="block -mt-4 italic text-sm font-medium text-purple-900 dark:text-white">User's ID: {{ user.user_id }}</label>
                    </div>
                    <form @submit.prevent="updateUser(user.id)" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User's name</label>
                            <input
                                v-model="formData.name"
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John Doe"
                            >
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User's email</label>
                            <input
                                v-model="formData.email"
                                type="email"
                                name="email"
                                id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com"
                            >
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input
                                v-model="formData.password"
                                type="password"
                                name="password"
                                id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="••••••••"
                            >
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input
                                v-model="formData.password_confirmation"
                                type="password"
                                name="confirm-password"
                                id="confirm-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="••••••••"
                            >
                        </div>

                        <button id="dropdownDefaultButton" 
                            data-dropdown-toggle="dropdown" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            type="button"
                            @click="showMenu = !showMenu">
                        Role 
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="p-2 z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-50 dark:bg-gray-700" :class="{ show: showMenu }">
                            <div class="p-3" v-for="role in roles" :key="role.id">
                                <input
                                    :id="role.role_id"
                                    :value="role.role_id"
                                    v-model="formData.role_id"
                                    type="radio"
                                    name="default-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <label
                                    :for="role.role_id"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >
                                    {{ role.role }}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
    import axios from "axios";
    import { ref, onMounted, onUnmounted } from 'vue';
    import { IFormData } from "../globals";
    const props = defineProps(['id']);

    interface IUser {
        name: string,
        id: number
    }

    const showMenu = ref(false);
    const user = ref<[IUser]>([]);
    let roles = ref([]);
    const formData = ref<IFormData>({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role_id: null,
    });

    const error = ref(null)
    const showError = ref(true);

    const success = ref(null)
    const showSuccess = ref(true);

    const closeDropdown = () => {
        if (showMenu.value) {
            showMenu.value = false;
        }
    };

    const getUser = async () => {
        await axios.get('http://127.0.0.1:8000/api/get-users/' + props.id)
            .then((response) => {
                user.value = response.data;
            })
            .catch((error) => {
                console.error('Error fetching user:', error);
            });
    };

    const getRoles = async () => {
        await axios.get('http://127.0.0.1:8000/api/get-roles')
            .then((response) => {
                roles.value = response.data;
            })
            .catch((err)=> {
                console.log(err)
            })
    }

    const updateUser = async (userId: number) => {
        // Get those fields which are filled
        const requestData = {};
        for (const key in formData.value) {
            if (formData.value[key]) {
                requestData[key] = formData.value[key];
                console.log(formData.value);
            }
        }

        await axios.put('http://127.0.0.1:8000/api/update-user/' + userId, requestData)
            .then((response) => {
                formData.value = {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role_id: null,
                };

                success.value = response.data.message || 'Success';
                showSuccess.value = true;

                setTimeout(() => {
                    showSuccess.value = false;
                }, 2000);
            })
            .catch((error) => {
                error.value = err.response.data.message || 'An error occurred.';

                showError.value = true;
                setTimeout(() => {
                    showError.value = false;
                }, 2000);
            });
    }


    const handleClickOutside = (event) => {
        const dropdown = document.getElementById('dropdown');
        const dropdownButton = document.getElementById('dropdownDefaultButton');
        if (dropdown && !dropdown.contains(event.target) && event.target !== dropdownButton) {
            closeDropdown();
        }
    };

    onMounted(() => {
        document.addEventListener('click', handleClickOutside);
        getRoles();
        getUser();
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside);
    });
</script>