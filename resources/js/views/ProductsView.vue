<template>
    <PageLayout>
        <!-- Search input and buttons -->
        <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between mb-4">
            <div class="mt-2 relative">
                <input type="text" id="search" class="w-full md:w-auto shadow-md px-3 py-2 border rounded-lg pl-10" placeholder="Search product">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <div class="flex justify-end ml-0 md:ml-2">
                <button class="w-full md:w-auto shadow-md bg-green-500 hover:bg-green-600 text-white text-md px-4 py-2 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Product
                </button>
            </div>
        </div>
  
            <!-- User cards -->
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
                        <tr v-for="product in products" :key="product.id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ product.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.shelf }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.row }}</td>
                            <td class="space-y-2 md:space-y-0 pr-3 p-2 text-right text-sm font-medium">
                                <button class="shadow-md md:mr-2 bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white">Edit</button>
                                <button class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                            </td>
                        </tr>
                    </tbody>

                    <tbody class="bg-blue-200">
                        <tr v-for="product in products" :key="product.id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ product.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.shelf }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.row }}</td>
                            <td class="space-y-2 md:space-y-0 pr-3 p-2 text-right text-sm font-medium">
                                <button class="shadow-md md:mr-2 bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white">Edit</button>
                                <button class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </PageLayout>
</template>

<script type="ts">
    import PageLayout from '@/components/PageLayout.vue';

    export default {
    components: {
        PageLayout,
    },
    data() {
        return {
        products: [
            // Example user data
            { id:  1, name: 'Chocolate cookies', category: 'Cookies', quantity: '518', shelf: '12', row: '2'},
            // Add more users as needed
        ],
        };
    },
    }
</script>