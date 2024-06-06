<template>
  <PageLayout>
    <!-- Search input and buttons -->
    <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between mb-4">
      <div class="mt-4 ml-6 relative">
        <h1 class="text-xl font-bold">Add Order</h1>
      </div>
    </div>
    <div
      v-if="success"
      :class="{ show: showSuccess, hide: !showSuccess }"
      class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
      role="alert"
    >
      <span class="font-medium">{{ success }}</span>
    </div>

    <AlertMessage :message="error" :show="showError" type="error" />

    <div class="mt-6 overflow-auto relative">
      <table class="min-w-full border-separate border-spacing-y-2">
        <thead>
          <tr class="bg-gray-300">
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Category
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Product name
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Manufacturer
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Quantity
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            ></th>
          </tr>
        </thead>
        <tbody class="bg-gray-100">
          <tr>
            <td>
              <Dropdown
                :v-model="formData.productId"
                :menuItems="category"
                apiEndpoint="/api/get-product"
                @selected="handleCategorySelect"
              />
            </td>
            <td>
              <Dropdown
                :v-model="formData.categoryId"
                :menuItems="products"
                apiEndpoint="/api/get-manufacturer"
                @selected="handleProductSelect"
              />
            </td>
            <td>
              <Dropdown :menuItems="manufacturers" @selected="handleManufacturerSelect" />
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <input
                v-model="formData.quantity"
                type="number"
                placeholder="0"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
              />
            </td>
            <td class="flex flex-col p-4 justify-end text-right text-sm font-medium">
              <button
                @click.prevent="makeOrder"
                type="submit"
                class="flex justify-center items-center shadow-md bg-emerald-600 hover:bg-emerald-500 p-3 px-6 rounded text-white text-center"
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
                    d="M12 4.5v15m7.5-7.5h-15"
                  />
                </svg>
                Make order
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </PageLayout>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import PageLayout from "@/components/PageLayout.vue";
import Dropdown from "@/components/Dropdown.vue";
import axios from "axios";

interface Option {
  id: number;
  label: string;
}

interface IFormData {
  quantity: number;
  productId: number;
  categoryId: number;
  manufacturerId: number;
}

const formData = ref<IFormData>({
  quantity: null,
  productId: null,
  categoryId: null,
  manufacturerId: null,
});

const success = ref(null);
const showSuccess = ref(true);
const error = ref(null);
const showError = ref(true);

const category = ref<Option[]>([]);
const products = ref<Option[]>([]);
const manufacturers = ref<Option[]>([]);
const userId = parseInt(localStorage.getItem("userId"));

const getCategories = async () => {
  await axios
    .get("http://127.0.0.1:8000/api/get-categories")
    .then((response) => {
      category.value = response.data;
      category.value = response.data.map((item) => {
        return {
          id: item.category_id,
          label: item.name,
        };
      });
    })
    .catch((error) => {
      console.error(error);
    });
};

const handleCategorySelect = (category: Option) => {
  formData.value.categoryId = category.id;
  getSelectedItemId(category.id, "http://127.0.0.1:8000/api/get-product", products);
};

const handleProductSelect = (product: Option) => {
  console.log(product);
  formData.value.productId = product.id;
  getSelectedItemId(
    product.id,
    "http://127.0.0.1:8000/api/get-manufacturer",
    manufacturers
  );
};

const handleManufacturerSelect = (manufacturer: Option) => {
  console.log(manufacturer);
  formData.value.manufacturerId = manufacturer.id;
};

const getSelectedItemId = (id: number, apiEndpoint: string, store: ref<Option[]>) => {
  axios
    .post(apiEndpoint, { id })
    .then((response) => {
      store.value = response.data.map((item: any) => ({
        id: item.id,
        label: item.name,
      }));
    })
    .catch((error) => {
      console.error(error);
    });
};

const makeOrder = async () => {
  await axios
    .post("http://127.0.0.1:8000/api/make-order", {
      userId: userId,
      manufactureId: formData.value.manufacturerId,
      productId: formData.value.productId,
      categoryId: formData.value.categoryId,
      count: formData.value.quantity,
    })
    .then((response) => {
      success.value = response.data.message || "Success";
      showSuccess.value = true;

      setTimeout(() => {
        showSuccess.value = false;
      }, 2000);
    })
    .catch((err) => {
      error.value = err.response.data.message || "An error occurred.";

      showError.value = true;
      setTimeout(() => {
        showError.value = false;
      }, 2000);
    });
};

onMounted(() => {
  getCategories();
});
</script>
