<script setup>
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';
import Modal from '@/Components/Breeze/Modal.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

const props = defineProps({
  coverLetterTemplate: Object,
});

const showModal = ref(false);
const loading = ref(false);
const response = ref('');

const form = useForm({
  prompt: '',
});

const submit = () => {
  loading.value = true;

  setTimeout(() => {
    response.value = 'This is a response to the prompt.';
    loading.value = false;
  }, 2000);
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
          Need some tips?
        </h3>
        <p class="text-sm text-neutral-300">
          Use the assistant to help you write a cover letter.
        </p>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        <div class="w-full">
          <InputLabel for="prompt" value="Prompt" />
          <TextArea
            v-model="form.prompt"
            id="prompt"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
        </div>

        <div class="w-full flex justify-end">
          <PrimaryButton
            type="submit"
            class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          >
            Generate
          </PrimaryButton>
        </div>

        <div v-if="form.prompt">
          <div class="bg-neutral-700 p-4 rounded-lg">
            <code class="text-neutral-300 text-sm">
              <LoadingSpinner v-if="loading" />
              <span v-else>
                <span v-if="response && response.length">
                  {{ response }}
                </span>
                <span v-else> Write a response to the prompt above. </span>
              </span>
            </code>
          </div>
        </div>
      </form>
    </div>
  </Modal>
</template>
