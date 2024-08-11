<script setup>
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';
import Modal from '@/Components/Breeze/Modal.vue';
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import InputError from '@/Components/Breeze/InputError.vue';

const props = defineProps({
  resume: Object,
});

const showModal = ref(false);
const selectedStarterQuestion = ref(0);
const loading = ref(false);
const response = ref('');
const hasGenerated = ref(false);

watch(
  () => selectedStarterQuestion.value,
  () => {
    form.prompt = starterQuestions.value[selectedStarterQuestion.value];
  }
);

const starterQuestions = ref([
  'What are some general tips for improving this resume?',
  'What are some common mistakes to avoid in this resume?',
  'What are some ways to make this resume more professional?',
]);

const form = useForm({
  prompt: starterQuestions.value[selectedStarterQuestion.value],
});

const submit = () => {
  loading.value = true;

  setTimeout(() => {
    response.value = 'This is a response to the prompt.';
    selectedStarterQuestion.value = 0;
    hasGenerated.value = true;
    loading.value = false;
  }, 2000);
};

const reset = () => {
  hasGenerated.value = false;
  form.reset();
  response.value = '';
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

      <div class="mb-4 space-y-2">
        <button
          v-for="(question, index) in starterQuestions"
          :key="index"
          @click.prevent="selectedStarterQuestion = index"
          class="w-full text-left px-4 py-2 rounded-lg font-medium shadow-sm transition duration-150 ease-in-out"
          :class="{
            'bg-orange-400 text-white': selectedStarterQuestion === index,
            'bg-neutral-400 text-white hover:bg-orange-300':
              selectedStarterQuestion !== index,
          }"
        >
          {{ question }}
        </button>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        <div class="w-full">
          <InputLabel for="prompt" value="Prompt" />
          <TextArea
            v-model="form.prompt"
            id="prompt"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
          <InputError :message="form.errors.prompt" />
        </div>

        <div class="w-full flex justify-end">
          <PrimaryButton
            v-if="!hasGenerated"
            type="submit"
            class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          >
            Generate
          </PrimaryButton>
          <SecondaryButton v-else @click.prevent="reset">
            Reset
          </SecondaryButton>
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
