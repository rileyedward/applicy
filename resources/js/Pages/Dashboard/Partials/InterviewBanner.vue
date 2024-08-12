<script setup>
import { computed, ref } from 'vue';
import InterviewSettingsModal from '@/Pages/Dashboard/Partials/InterviewSettingsModal.vue';

const props = defineProps({
  interview: Object,
});

const formattedDate = computed(() => {
  return new Date(props.interview.interview_date).toLocaleDateString([], {
    weekday: 'short',
    month: 'short',
    day: 'numeric',
    timeZone: 'UTC',
  });
});

const formattedTime = computed(() => {
  return new Date(
    `1970-01-01T${props.interview.interview_time}`
  ).toLocaleTimeString([], {
    hour: '2-digit',
    minute: '2-digit',
  });
});

const selectedInterview = ref(null);
const isModalOpen = ref(false);

const openSettingsModal = () => {
  selectedInterview.value = props.interview;
  isModalOpen.value = true;
};
</script>

<template>
  <InterviewSettingsModal
    :interview="selectedInterview"
    :show="isModalOpen"
    @close="isModalOpen = false"
  />

  <div
    class="bg-neutral-800 p-4 rounded-lg hover:scale-105 cursor-pointer transition-transform"
    @click.prevent="openSettingsModal"
  >
    <div class="flex flex-col-reverse md:flex-row items-center justify-between">
      <div class="text-center md:text-left">
        <h4 class="text-neutral-100 font-semibold text-xl">
          {{ interview.job_application.position }}
        </h4>
        <p class="text-neutral-400 text-sm">
          {{ interview.job_application.company_name }}
        </p>
      </div>

      <div
        class="text-right flex flex-row md:flex-col items-center gap-4 md:gap-0"
      >
        <p class="text-neutral-300 text-sm">
          {{ formattedDate }}
        </p>
        <p class="text-neutral-300 text-sm">
          <span class="text-orange-500 font-bold">@</span>
          {{ formattedTime }}
        </p>
      </div>
    </div>
  </div>
</template>
