<script setup>
import { ref } from 'vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';

const props = defineProps({
  jobApplication: Object,
  coverLetterTemplateSelections: Array,
});

const selectedCoverLetterTemplate = ref(null);
const loading = ref(false);
const response = ref('');
const hasGenerated = ref(false);

const submit = () => {
  loading.value = true;

  axios
    .post(
      route('assistant.application.cover-letter', props.jobApplication.id),
      {
        cover_letter_template_id: selectedCoverLetterTemplate?.value ?? null,
      }
    )
    .then((res) => {
      response.value = res.data;
      hasGenerated.value = true;
      loading.value = false;
    });
};

const reset = () => {
  hasGenerated.value = false;
  response.value = '';
};
</script>

<template>
  <div>
    <p class="text-base text-neutral-300 my-4">
      Utilize our AI assistant to generate a cover letter
    </p>

    <form @submit.prevent="submit" class="space-y-6">
      <div v-if="coverLetterTemplateSelections.length > 0" class="w-full">
        <InputLabel
          for="cover_letter"
          value="Select one of your cover letters as a template"
        />
        <SelectInput
          v-model="selectedCoverLetterTemplate"
          :options="coverLetterTemplateSelections ?? []"
          id="cover_letter"
          class="mt-1 block w-full bg-neutral-700 border-none scrollbar-hide"
        />
      </div>

      <div class="w-full flex justify-end">
        <PrimaryButton
          v-if="!hasGenerated"
          type="submit"
          class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
        >
          Generate
        </PrimaryButton>
        <SecondaryButton v-else @click.prevent="reset"> Reset </SecondaryButton>
      </div>

      <div>
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
