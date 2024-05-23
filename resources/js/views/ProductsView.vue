<template>
  <PageLayout>
    <!-- Search input and buttons -->
    <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between">
      <Search placeholderText="Search Product" @update:search="searchText = $event" />
      <div class="flex justify-end ml-0 md:ml-2">
        <router-link
          :to="{ name: 'addproduct' }"
          class="shadow-md bg-emerald-600 hover:bg-emerald-500 text-white text-md px-4 py-2 w-full md:w-auto rounded-lg flex items-center justify-center"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-1 w-5 h-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 4.5v15m7.5-7.5h-15"
            />
          </svg>
          Add Product
        </router-link>
      </div>
    </div>

    <!-- Product cards -->
    <div class="mt-6 overflow-auto relative">
      <table class="min-w-full border-separate border-spacing-y-2">
        <thead>
          <tr class="bg-gray-300">
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              ID
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Name
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Quantity
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Category
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Shelf
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Column
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Row
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            ></th>
          </tr>
        </thead>

        <tbody class="bg-gray-100">
          <tr v-for="product in filteredProducts" :key="product.product_id">
            <td class="font-bold px-6 py-4 whitespace-nowrap">
              {{ product.product_id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity_in_stock }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.category }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.shelf }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.column }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ product.row }}</td>
            <td
              class="flex flex-col gap-1 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium"
            >
              <router-link
                :to="{ name: 'editproduct', params: { id: product.product_id } }"
                class="flex shadow-md bg-blue-600 hover:bg-blue-500 p-3 px-6 rounded text-white text-center"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                  /></svg
                >Edit</router-link
              >
              <button
                @click="deleteProduct(product.product_id, userRoleId)"
                class="flex shadow-md bg-red-600 hover:bg-red-500 p-3 px-4 rounded text-white"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                  /></svg
                >Delete
              </button>
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
import { onMounted, ref, computed } from "vue";

const products = ref([]);
const searchText = ref('');

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

const getProductLocations = async () => {
  await axios.get('http://127.0.0.1:8000/api/get-product-location')
    .then((response) => {
      const productLocations = response.data.data;
      products.value = products.value.map((product) => {
        const location = productLocations.find(loc => loc.product_id === product.product_id);
        if (location) {
          return {
            ...product,
            shelf: location.shelf_id,
            column: location.column,
            row: location.row
          };
        }
        return product;
      });
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
        getProductLocations();
    })
    .catch((err)=> {
        console.log(err);
    })
}

const filteredProducts = computed(() => {
    if (!searchText.value) return products.value;
    const searchNumber = parseInt(searchText.value, 10);
    return products.value.filter(product => {
        if (!isNaN(searchNumber)) {
            return product.product_id === searchNumber ||
                   product.quantity_in_stock === searchNumber ||
                   product.shelf === searchNumber ||
                   product.column === searchNumber ||
                   product.row === searchNumber;
        }
        return product.name.toLowerCase().includes(searchText.value.toLowerCase()) ||
               (product.shelf && product.shelf.toLowerCase().includes(searchText.value.toLowerCase())) ||
               (product.column && product.column.toLowerCase().includes(searchText.value.toLowerCase())) ||
               (product.row && product.row.toLowerCase().includes(searchText.value.toLowerCase()));
    });
});

onMounted(() => {
  getProducts();
  getProductLocations();
});
</script>
