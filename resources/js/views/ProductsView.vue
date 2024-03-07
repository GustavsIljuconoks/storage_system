<template>
    <PageLayout>
        <!-- Search input and buttons -->
        <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between">
            <Search placeholderText="Search product"/>
            <div class="flex justify-end ml-0 md:ml-2">
                <router-link :to="{name: 'addproduct'}" 
                    class="shadow-md bg-green-500 hover:bg-green-600 text-white text-md px-4 py-2 w-full md:w-auto rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Product
                </router-link>
            </div>
        </div>
  
            <!-- Product cards -->
            <div class="mt-6 overflow-auto relative">
                <table class="min-w-full border-separate border-spacing-y-2">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shelf</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Row</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-blue-200">
                        <tr v-for="product in products" :key="product.product_id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ product.product_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity_in_stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.shelf }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.row }}</td>
                            <td class="flex flex-col gap-1 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium">
                                <router-link :to="{name: 'editproduct', params: { id: product.product_id }}" class="shadow-md bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white text-center">Edit</router-link>
                                <button @click="deleteProduct(product.product_id, userRoleId)" class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </PageLayout>
</template>

<script setup type="ts">
    import PageLayout from '@/components/PageLayout.vue';
    import Search from '@/components/Search.vue';
    import axios from "axios";
    import { onMounted, ref } from "vue";

    const products = ref([]);

    const userRoleId = parseInt(localStorage.getItem('roleId'));

    const getProducts = async () => {
            await axios.get('http://127.0.0.1:8000/api/get-products')
                .then((response) => {
                    products.value = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
    };



    const deleteProduct = async (productId, userRoleId) => {
        await axios.delete('http://127.0.0.1:8000/api/delete-product', {
            data: {
                productId: productId,
                userRoleId: userRoleId
            }
        })
        .then((response) => {
            getProducts();
        })
        .catch((err)=> {
            console.log(err);
        })
    }

    onMounted(getProducts);
</script>