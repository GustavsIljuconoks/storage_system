<style>
.show {
  display: block;
}
</style>

<template>
  <section class="dark:bg-gray-500 mt-4">
    <div class="flex flex-col items-center justify-center p-4 md:p-0 mx-auto lg:py-0">
      <div
        class="w-full bg-gray-100 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-2 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Edit Product
          </h1>
          <p class="mb-2 text-purple-900 font-medium">"{{ product.name }}"</p>

          <AlertMessage :message="error" :show="showError" type="error" />
          <AlertMessage :message="success" :show="showSuccess" type="success" />

          <form
            @submit.prevent="updateProduct(product.product_id)"
            class="space-y-4 md:space-y-6"
          >
            <div>
              <label
                for="id"
                class="block mt-2 text-sm font-medium text-purple-900 dark:text-white"
                >Product's ID: {{ product.product_id }}</label
              >
            </div>
            <div>
              <label
                for="name"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
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
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                  />
                </svg>
                Change name</label
              >
              <input
                v-model="formData.name"
                type="text"
                name="name"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Product Name"
              />
            </div>
            <div>
              <label
                for="quantity"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
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
                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                  />
                </svg>
                Quantity</label
              >
              <input
                v-model="formData.quantity_in_stock"
                type="text"
                name="quantity"
                id="quantity"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="..."
              />
            </div>
            <button
              type="submit"
              class="flex items-center justify-center w-full text-white bg-emerald-600 hover:bg-emerald-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"
                />
              </svg>
              Update
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import axios from "axios";
import AlertMessage from "@/components/AlertMessage.vue";
const props = defineProps(["id", "quantity"]);

interface IProduct {
  name: string;
  product_id: number;
}

interface IFormData {
  name: string;
  quantity_in_stock: number;
  userRoleId: number;
}

const error = ref(null);
const showError = ref(true);
const success = ref(null);
const showSuccess = ref(true);

const roleId = parseInt(localStorage.getItem("roleId"));
const userId = parseInt(localStorage.getItem("userId"));
const showMenu = ref(false);
const product = ref<[IProduct]>([]);
const formData = ref<IFormData>({
  name: "",
  quantity_in_stock: 0,
  userRoleId: roleId,
});

const productDetail = async () => {
  await axios
    .get("http://127.0.0.1:8000/api/get-products/" + props.id)
    .then((response) => {
      product.value = response.data;
    })
    .catch((error) => {
      console.error("Error fetching product:", error);
    });
};

const updateProduct = async (productId: number) => {
  // Get those fields which are filled
  const requestData = {};
  for (const key in formData.value) {
    if (formData.value[key]) {
      requestData[key] = formData.value[key];
    }
  }

  await axios
    .put("http://127.0.0.1:8000/api/update-product/" + productId, {
      requestData,
      userId: userId,
    })
    .then((response) => {
      formData.value = {
        name: "",
        quantity_in_stock: 0,
        userRoleId: 0,
      };
      success.value = response.data.message || "Product edited sucessfully";
      showSuccess.value = true;

      setTimeout(() => {
        showSuccess.value = false;
      }, 2000);
    })
    .catch((error) => {
      error.value = err.response.data.message || "An error occurred.";

      showError.value = true;
      setTimeout(() => {
        showError.value = false;
      }, 2000);
    });
};

const closeDropdown = () => {
  if (showMenu.value) {
    showMenu.value = false;
  }
};

const handleClickOutside = (event) => {
  const dropdown = document.getElementById("dropdown");
  const dropdownButton = document.getElementById("dropdownDefaultButton");
  if (dropdown && !dropdown.contains(event.target) && event.target !== dropdownButton) {
    closeDropdown();
  }
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
  productDetail();
});

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>
