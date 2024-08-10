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
      class="bg-neutral-800 hover:bg-orange-500 p-2 rounded-full font-bold text-white cursor-pointer"
    >
      {{ initials }}
    </div>
    <div
      v-if="dropdownOpen"
      class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-neutral-800 ring-1 ring-gray-600 z-50"
    >
      <div>
        <a
          :href="route('profile.index')"
          class="w-full block px-4 py-2 text-sm text-gray-300 hover:bg-orange-600 hover:text-white text-left rounded-t-md"
          >Profile</a
        >
        <button
          class="w-full block px-4 py-2 text-sm text-gray-300 hover:bg-orange-600 hover:text-white text-left rounded-b-md"
          @click.prevent="logout"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>
