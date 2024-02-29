<template>
    <PageLayout>
        <!-- Search input and buttons -->
        <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between mb-4">
            <div class="mt-4 ml-6 relative">
                <h1 class="text-xl font-bold">Add Order</h1>
            </div>
        </div>
        
            <div class="mt-6 overflow-auto relative">
                <table class="min-w-full border-separate border-spacing-y-2">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-blue-200">
                        <tr v-for="product in products" :key="product.id">
                            <td><Dropdown :menuItems="menuItems2"/></td>
                            <td><Dropdown :menuItems="otherItems"/></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" placeholder="0" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            </td>
                            <td class="flex flex-col p-4 justify-end text-right text-sm font-medium">
                                <router-link :to="{name: ''}" class="shadow-md bg-green-600 hover:bg-green-800 p-3 px-6 rounded text-white text-center">Make Order</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </PageLayout>
</template>

<script setup>
    import { ref } from 'vue'
    import PageLayout from '@/components/PageLayout.vue'
    import Dropdown from '@/components/Dropdown.vue'

    const menuItems2 = ref([
        { label: 'Edit' },
        { label: 'Duplicate' },
        { label: 'Move' },  
    ])

    const otherItems = ref([
        { label: 'test' },
        { label: 'kas i ko' },
        { label: 'vecuk' },  
    ])

    const products = [
        { id: 1, name: 'Chocolate cookies', category: 'Cookies' },
        // Add more users as needed
    ]
</script>