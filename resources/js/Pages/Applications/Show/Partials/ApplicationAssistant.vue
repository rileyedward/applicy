<script setup>
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';
import { ref } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';

const props = defineProps({
  jobApplication: Object,
});

const showModal = ref(false);
</script>

<template>
  <div>
    <button>
      <AssistantIcon @click.prevent="showModal = true" />
    </button>

    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6">
        <div class="mb-4">
          <h3 class="text-lg font-medium text-neutral-100 mb-1">
            Need some tips?
          </h3>
          <p class="text-sm text-neutral-300">
            Use the assistant to help you with your job application.
          </p>
        </div>
      </div>
    </Modal>
  </div>
</template>

<style scoped></style>
