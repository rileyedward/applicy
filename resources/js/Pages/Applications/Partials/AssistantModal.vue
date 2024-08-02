<script setup>
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';

const showModal = ref(false);
const selectedAction = ref('');

const actions = [
  { name: 'Send Cover Letter', value: 'coverLetter' },
  { name: 'Send Follow-Up Message', value: 'followUp' },
  { name: 'Schedule an Interview', value: 'scheduleInterview' },
];

const handleActionSelect = (action) => {
  alert(action);
};
</script>

<template>
  <div>
    <button @click.prevent="showModal = true">
      <span
        class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-gray-300 text-gray-900 hover:bg-gray-900 hover:text-gray-300 cursor-pointer"
      >
        AI Assistant
      </span>
    </button>

    <Modal :show="showModal" @close="showModal = false">
      <h4 class="text-lg font-medium text-gray-900 mb-4">AI Assistant</h4>
      <div class="space-y-2">
        <div v-for="action in actions" :key="action.value">
          <button
            @click.prevent="handleActionSelect(action.value)"
            class="w-full text-left px-4 py-2 rounded-lg bg-gray-300 text-gray-800 font-medium shadow-sm hover:bg-gray-400 hover:text-white transition duration-150 ease-in-out"
          >
            {{ action.name }}
          </button>
        </div>
      </div>
    </Modal>
  </div>
</template>
