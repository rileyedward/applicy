<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

const dropdownOpen = ref(false);

onMounted(() => {
  window.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      dropdownOpen.value = false;
    }
  });
});

const initials = computed(() => {
  return usePage().props.auth.user.initials;
});

const logout = () => {
  useForm({}).delete(route('logout'));
};
</script>

<template>
  <div class="relative inline-block text-left">
    <div
      @click="dropdownOpen = !dropdownOpen"
      class="bg-neutral-800 p-2 rounded-full font-bold text-white cursor-pointer"
    >
      {{ initials }}
    </div>
    <div
      v-if="dropdownOpen"
      class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-neutral-800 ring-1 ring-gray-600"
    >
      <div class="py-1">
        <a
          href="#"
          class="w-full block px-4 py-2 text-sm text-gray-300 hover:bg-orange-600 hover:text-white text-left"
          >Profile</a
        >
        <button
          class="w-full block px-4 py-2 text-sm text-gray-300 hover:bg-orange-600 hover:text-white text-left"
          @click.prevent="logout"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>
