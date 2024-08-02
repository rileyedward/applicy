<script setup>
import { computed, ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  application: Object,
});

const showModal = ref(false);
const selectedAction = ref(null);
const isProcessing = ref(false);
const returnContent = ref('');

const actions = [
  {
    name: 'Send Cover Letter',
    value: 'coverLetter',
    description: 'Generate a cover letter for this application.',
  },
  {
    name: 'Send Follow-Up Message',
    value: 'followUp',
    description: 'Generate a follow-up message for this application.',
  },
];

const returnContentLines = computed(() => {
  return returnContent.value.split('\n');
});

const resetContent = () => {
  returnContent.value = '';
};

const handleAction = () => {
  switch (selectedAction.value) {
    case 'coverLetter':
      coverLetter();
      break;
    case 'followUp':
      // followUp();
      break;
    default:
      break;
  }
};

const coverLetter = () => {
  returnContent.value = '';
  isProcessing.value = true;
  axios
    .get(
      route('application.cover-letter', { application: props.application.id })
    )
    .then((response) => {
      returnContent.value = response.data.cover_letter;
      isProcessing.value = false;
    })
    .catch((error) => {
      console.log(error.response.data);
    });
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

    <Modal :show="showModal" maxWidth="4xl" @close="showModal = false">
      <h4 class="text-lg font-medium text-gray-900 mb-4">AI Assistant</h4>
      <div class="space-y-2">
        <div v-for="action in actions" :key="action.value">
          <button
            @click.prevent="selectedAction = action.value"
            class="w-full text-left px-4 py-2 rounded-lg bg-gray-300 text-gray-800 font-medium shadow-sm hover:bg-gray-400 hover:text-white transition duration-150 ease-in-out"
            :class="{
              'bg-gray-400 text-white': selectedAction === action.value,
            }"
          >
            {{ action.name }}
          </button>
        </div>

        <hr class="border-t-3 border-gray-200" />

        <div v-if="selectedAction" class="mt-2">
          <p class="text-base text-gray-800">
            {{
              actions.find((action) => action.value === selectedAction)
                .description
            }}
          </p>
        </div>
      </div>

      <div v-if="selectedAction" class="flex justify-end mt-4">
        <SecondaryButton v-if="returnContent" @click.prevent="resetContent">
          Reset
        </SecondaryButton>
        <PrimaryButton v-else @click.prevent="handleAction">
          Generate Content
        </PrimaryButton>
      </div>

      <div
        v-if="isProcessing"
        class="bg-gray-100 shadow-sm p-4 rounded-2xl mt-8 flex justify-center"
      >
        <div
          class="w-8 h-8 border-2 border-t-2 border-gray-900 rounded-full animate-spin"
        ></div>
      </div>

      <div
        v-if="returnContent"
        class="bg-gray-100 shadow-sm p-4 rounded-2xl mt-8 space-y-1"
      >
        <p
          v-for="(line, index) in returnContentLines"
          :key="index"
          class="text-sm text-gray-800"
        >
          {{ line }}
        </p>
      </div>
    </Modal>
  </div>
</template>

<style scoped>
/* Optional: Customize spinner animation duration */
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
