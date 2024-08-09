<script setup>
import Modal from '@/Components/Breeze/Modal.vue';

defineProps({
  show: Boolean,
  selectedEducationExperience: {
    type: Object,
    required: false,
  },
});

defineEmits(['close']);
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6">
      <h1>Education Experience form will go here...</h1>
    </div>
  </Modal>
</template>
