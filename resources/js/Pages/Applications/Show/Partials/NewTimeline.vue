<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref } from 'vue';

const showModal = ref(false);
</script>

<template>
  <div>
    <button
      @click="showModal = true"
      class="flex items-center justify-center bg-orange-500 text-white w-10 h-10 rounded-full shadow-md hover:bg-orange-600 hover:scale-105"
      aria-label="Add"
    >
      <span class="text-2xl">+</span>
    </button>

    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">New Action</h3>
        <p class="text-sm text-neutral-300 mb-6">
          Add a new action to your application timeline.
        </p>
      </div>
    </Modal>
  </div>
</template>
