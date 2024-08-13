<script setup>
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';
import Modal from '@/Components/Breeze/Modal.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import { ref } from 'vue';

const emits = defineEmits(['populateCoverLetter']);

const showModal = ref(false);
const loading = ref(false);

const generateNewCoverLetter = () => {
  loading.value = true;

  axios.post(route('assistant.cover-letter.new')).then((res) => {
    const response = res.data;
    emits('populateCoverLetter', response);
    loading.value = false;
    showModal.value = false;
  });
};
</script>

<template>
  <button @click.prevent="showModal = true">
    <AssistantIcon />
  </button>

  <Modal :show="showModal" @close="showModal = false">
    <div class="p-6">
      <div class="mb-4">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">
          Need some help on your cover letter?
        </h3>
        <p class="text-sm text-neutral-300">
          Generate a new cover letter template to use when applying for jobs.
        </p>
      </div>

      <div class="w-fit my-6">
        <LoadingSpinner v-if="loading" />
      </div>

      <div>
        <PrimaryButton
          @click.prevent="generateNewCoverLetter"
          class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          :disabled="loading"
          :class="{
            'cursor-not-allowed': loading,
            'opacity-50': loading,
          }"
        >
          Generate
        </PrimaryButton>
      </div>
    </div>
  </Modal>
</template>
