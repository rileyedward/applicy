<script setup>
import { ref, watch } from 'vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';

defineProps({
  jobApplication: Object,
});

const selectedStarterQuestion = ref(null);
const loading = ref(false);
const response = ref('');
const hasGenerated = ref(false);

watch(
  () => selectedStarterQuestion.value,
  () => {
    prompt.value = starterQuestions.value[selectedStarterQuestion.value];
  }
);

const starterQuestions = ref([
  'Craft a follow up message to the employer after submitting your application.',
  'Ask the employer about the status of your application.',
  'Request feedback on your application to improve your chances of success.',
]);

const prompt = ref(starterQuestions.value[selectedStarterQuestion.value]);

const submit = () => {
  loading.value = true;

  axios
    .post(route('applications.assistant.contact', props.jobApplication.id), {
      prompt: prompt.value,
    })
    .then((res) => {
      response.value = res.data;
      hasGenerated.value = true;
      loading.value = false;
    });
};

const reset = () => {
  hasGenerated.value = false;
  selectedStarterQuestion.value = 0;
  prompt.value = starterQuestions.value[selectedStarterQuestion.value];
  response.value = '';
};
</script>

<template>
  <div>
    <div class="mb-4">
      <h3 class="text-lg font-medium text-neutral-100 mb-1">
        Need some tips on reaching out to the employer?
      </h3>
      <p class="text-sm text-neutral-300">
        Use the AI assistant below to help you craft the perfect message.
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
        <InputLabel for="prompt" value="What would you like help on?" />
        <TextArea
          v-model="prompt"
          id="prompt"
          rows="2"
          class="mt-1 block w-full bg-neutral-700 border-none scrollbar-hide"
        />
      </div>

      <div class="w-full flex justify-end">
        <PrimaryButton
          v-if="!hasGenerated"
          type="submit"
          class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          :class="{
            'cursor-not-allowed bg-neutral-400': !prompt,
          }"
          :disabled="!prompt"
        >
          Generate
        </PrimaryButton>
        <SecondaryButton v-else @click.prevent="reset"> Reset </SecondaryButton>
      </div>

      <div v-if="prompt">
        <div
          class="bg-neutral-700 p-4 rounded-lg max-h-[350px] overflow-y-auto scrollbar-hide"
        >
          <code class="text-neutral-300 text-sm">
            <LoadingSpinner v-if="loading" />
            <span v-else>
              <span
                v-if="response && response.length"
                class="whitespace-pre-wrap"
              >
                {{ response }}
              </span>
              <span v-else> Waiting for response... </span>
            </span>
          </code>
        </div>
      </div>
    </form>
  </div>
</template>
