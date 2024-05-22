<style>
.show {
  display: block;
}
</style>

<template>
  <section class="dark:bg-gray-500 mt-4">
    <div class="flex flex-col items-center justify-center mx-auto lg:py-0">
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
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Change name</label
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
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Quantity</label
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
              class="w-full text-white bg-emerald-600 hover:bg-emerald-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
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
