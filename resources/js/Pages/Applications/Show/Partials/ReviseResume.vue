<script setup>
import { ref } from 'vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';

const props = defineProps({
  jobApplication: Object,
  resumeSelections: Array,
});

const selectedResume = ref(null);
const loading = ref(false);
const response = ref('');
const hasGenerated = ref(false);

const submit = () => {
  loading.value = true;

  axios
    .post(route('assistant.application.resume', props.jobApplication.id), {
      resume_id: selectedResume?.value ?? null,
    })
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
    <p class="text-base text-neutral-300 max-w-2xl my-4">
      Utilize our AI assistant to get some tips on how you can maximize your
      resume for this job application.
    </p>

    <form @submit.prevent="submit" class="space-y-6">
      <div v-if="resumeSelections.length > 0" class="w-full">
        <InputLabel
          for="cover_letter"
          value="Select one of your resumes to revise"
        />
        <SelectInput
          v-model="selectedResume"
          :options="resumeSelections ?? []"
          id="cover_letter"
          class="mt-1 block w-full bg-neutral-700 border-none scrollbar-hide"
        />
      </div>

      <div class="w-full flex justify-end">
        <PrimaryButton
          v-if="!hasGenerated"
          type="submit"
          class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          :disabled="!selectedResume"
          :class="{
            'cursor-not-allowed opacity-50': !selectedResume,
          }"
        >
          Generate
        </PrimaryButton>
        <SecondaryButton v-else @click.prevent="reset"> Reset </SecondaryButton>
      </div>

      <div v-if="selectedResume">
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
