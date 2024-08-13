<script setup>
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const isVisible = ref(false);

watch(
  () => usePage().props.flash?.message,
  (newMessage) => {
    if (newMessage) {
      isVisible.value = true;
    }
  }
);
</script>

<template>
  <div
    v-if="isVisible"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center px-4 py-6 sm:items-start sm:justify-end pointer-events-auto transition-opacity duration-300"
    :class="{
      'opacity-100': $page?.props?.flash?.message && isVisible,
      'opacity-0': !$page?.props?.flash?.message || !isVisible,
    }"
  >
    <div
      class="max-w-sm w-full bg-orange-400 text-white text-sm rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
    >
      <div class="p-4 flex items-center">
        <div class="flex-1">
          <p class="font-semibold" v-html="$page?.props?.flash?.message"></p>
        </div>
        <button
          @click.prevent="isVisible = false"
          class="ml-4 flex-shrink-0 text-white"
        >
          <span class="text-lg font-semibold"> X </span>
        </button>
      </div>
    </div>
  </div>
</template>
