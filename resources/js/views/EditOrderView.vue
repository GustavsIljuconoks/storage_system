<style>
    .show {
        display: block;
    }
</style>

<template>
    <section class=" dark:bg-gray-500">
        <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0">
            <div class="mt-5 -mb-10 w-full bg-blue-200 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Edit Order
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="id" class="block -mt-4 italic text-sm font-medium text-purple-900 dark:text-white">Order's ID: {}</label>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order's name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        </div>
                        <div>
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                            <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="...">
                        </div>

                        <button id="dropdownDefaultButton" 
                            data-dropdown-toggle="dropdown" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            type="button"
                            @click="showMenu = !showMenu">
                        Status 
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="p-2 z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-50 dark:bg-gray-700" :class="{ show: showMenu }">
                            <div class="p-3">
                                <input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category 1</label>
                            </div>
                            <div class="p-3">
                                <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category 2</label>
                            </div>
                            <div class="p-3">
                                <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category 3</label>
                            </div>
                        </div>

                        <!-- Add another dropdown btn for status -->
                        
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
    import { ref, onMounted, onUnmounted } from 'vue';

    const showMenu = ref(false);

    const closeDropdown = () => {
        if (showMenu.value) {
            showMenu.value = false;
        }
    };

    const handleClickOutside = (event) => {
        const dropdown = document.getElementById('dropdown');
        const dropdownButton = document.getElementById('dropdownDefaultButton');
        if (dropdown && !dropdown.contains(event.target) && event.target !== dropdownButton) {
            closeDropdown();
        }
    };

    onMounted(() => {
        document.addEventListener('click', handleClickOutside);
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside);
    });
</script>