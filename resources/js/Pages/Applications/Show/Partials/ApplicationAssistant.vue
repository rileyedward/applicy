<script setup>
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';
import { ref } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';
import GenerateCoverLetter from '@/Pages/Applications/Show/Partials/GenerateCoverLetter.vue';

const props = defineProps({
  jobApplication: Object,
  coverLetterTemplateSelections: Array,
});

const showModal = ref(false);
const selectedAction = ref('cover-letter');
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

        <div class="flex gap-4">
          <button
            :class="{
              'bg-orange-500': selectedAction === 'cover-letter',
              'bg-neutral-100 text-neutral-400':
                selectedAction !== 'cover-letter',
            }"
            @click="selectedAction = 'cover-letter'"
            class="flex-1 py-2 px-4 rounded-md text-sm font-medium"
          >
            Cover Letter
          </button>
          <button
            :class="{
              'bg-orange-500': selectedAction === 'revise-resume',
              'bg-neutral-100 text-neutral-400':
                selectedAction !== 'revise-resume',
            }"
            @click="selectedAction = 'revise-resume'"
            class="flex-1 py-2 px-4 rounded-md text-sm font-medium"
          >
            Revise Resume
          </button>
        </div>

        <GenerateCoverLetter
          v-if="selectedAction === 'cover-letter'"
          :jobApplication="jobApplication"
          :coverLetterTemplateSelections="coverLetterTemplateSelections"
        />

        <div v-else-if="selectedAction === 'revise-resume'" class="my-6">
          <p class="text-sm text-neutral-300">Coming soon...</p>
        </div>
      </div>
    </Modal>
  </div>
</template>

<style scoped></style>
