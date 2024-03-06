<template>
    <section class=" dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                Storage control system
            </a>
            <div class="w-full bg-blue-200 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login
                    </h1>
                    <form @submit.prevent="login" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input v-model="formData.email"
                                type="email"
                                name="email"
                                id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@gmail.com"
                            >
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input v-model="formData.password"
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
    import axios from "axios";
    import { useRouter } from "vue-router";
    import { ref } from "vue";

    const router = useRouter();
    const error = ref(null)
    const showError = ref(true);

    interface FormData {
        email: string,
        password: string,
    }

    const formData = ref<FormData>({
        email: '',
        password: '',
    });

    const login = async () => {
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/login', formData.value);
            var test = true;
            localStorage.setItem('userToken', response.data.token);
            localStorage.setItem("authenticated", JSON.stringify(test));

            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
            router.push({ name: 'home' });
        } catch (e) {
            error.value = e.response.data.message || 'An error occurred.';

            showError.value = true;
            setTimeout(() => {
                showError.value = false;
            }, 2000);
        }

        formData.value = {
            email: '',
            password: '',
        };
    };
</script>
