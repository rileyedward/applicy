<script setup>
import { computed } from 'vue';

const props = defineProps({
  interview: Object,
});

const formattedDate = computed(() => {
  return new Date(props.interview.interview_date).toLocaleDateString();
});

const formattedTime = computed(() => {
  return new Date(
    `1970-01-01T${props.interview.interview_time}`
  ).toLocaleTimeString([], {
    hour: '2-digit',
    minute: '2-digit',
  });
});
</script>

<template>
  <div
    class="bg-neutral-900 p-4 rounded-lg hover:scale-105 cursor-pointer transition-transform"
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
