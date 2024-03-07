<style>
    .show {
        display: block;
    }
</style>

<template>
    <section class=" dark:bg-gray-500">
        <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0">
            <div class="mt-5 -mb-10 w-full bg-blue-200 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-0 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Add Product
                    </h1>

                    <AlertMessage :message="error" :show="showError" type="error" />
                    <AlertMessage :message="success" :show="showSuccess" type="success" />

                    <form @submit.prevent="addProduct" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product's name</label>
                            <input
                                v-model="formData.name"
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="..."
                            >
                        </div>
                        <div>
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                            <input
                                v-model="formData.quantity_in_stock"
                                type="text"
                                name="quantity"
                                id="quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="..."
                            >
                        </div>

                        <!-- Dropdown button -->
                        <button id="dropdownDefaultButton" 
                            data-dropdown-toggle="dropdown" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            type="button"
                            @click="showMenu = !showMenu">
                        Category 
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="p-2 z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-50 dark:bg-gray-700" :class="{ show: showMenu }">
                            <div class="p-3" v-for="category in categories" :key="category.id">
                                <input
                                    :id="category.category_id"
                                    :value="category.category_id"
                                    v-model="formData.category_id"
                                    type="radio"
                                    name="default-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <label
                                    :for="category.category_id"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >
                                    {{ category.name }}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
    import { ref, onMounted, onUnmounted } from 'vue';
    import axios from "axios";
    import AlertMessage from "@/components/AlertMessage.vue";

    interface IFormData {
        name: string,
        quantity_in_stock: number,
        category_id: number,
    }

    const error = ref(null)
    const showError = ref(true);
    const success = ref(null)
    const showSuccess = ref(true);

    const showMenu = ref(false);
    const categories = ref(false);
    const formData = ref<IFormData>({
        name: '',
        quantity_in_stock: null,
        category_id: null,
    });

    const closeDropdown = () => {
        if (showMenu.value) {
            showMenu.value = false;
        }
    };

    const getCategories = async () => {
        await axios.get('http://127.0.0.1:8000/api/get-categories')
            .then((response) => {
                categories.value = response.data;
            })
            .catch((err)=> {
                console.log(err)
            })
    }

    const addProduct = async () => {
        await axios.post('http://127.0.0.1:8000/api/add-product', formData.value)
            .then((response) => {
                success.value = response.data.message || 'Product added sucessfully';
                showSuccess.value = true;

                setTimeout(() => {
                    showSuccess.value = false;
                }, 2000);
            })
            .catch((err)=> {
                error.value = err.response.data.message || 'An error occurred.';

                showError.value = true;
                setTimeout(() => {
                    showError.value = false;
                }, 2000);
            })
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
        getCategories();
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside);
    });
</script>