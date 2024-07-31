<script setup>
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

defineProps({
  application: Object,
});

const showModal = ref(false);
</script>

<template>
  <button @click.prevent="showModal = true">
    <span
      class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-green-300 text-green-900 hover:bg-green-900 hover:text-green-300 cursor-pointer"
    >
      {{ application.status }}
    </span>
  </button>
  <Modal :show="showModal" @close="showModal = false">
    <p>Form will go here soon...</p>
  </Modal>
</template>
