<script setup>
import { computed } from 'vue';

const props = defineProps({
  jobApplication: Object,
});

const gotoApplication = () => {
  window.location.href = `/applications/${props.jobApplication.id}`;
};
</script>

<template>
  <div
    class="p-6 bg-neutral-800 rounded-md shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer"
    @click.prevent="gotoApplication"
  >
    <div class="flex justify-between items-start">
      <div>
        <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
          {{ jobApplication.position }}
        </h2>
        <p class="text-lg text-gray-400 flex items-center gap-2">
          {{ jobApplication.company_name }}
        </p>
      </div>

      <div
        class="flex flex-col md:flex-row-reverse justify-center items-center gap-2 md:gap-4"
      >
        <div
          class="px-3 py-1 text-sm font-semibold rounded-full text-white bg-green-500"
        >
          {{ jobApplication.status_pretty }}
        </div>
        <p class="text-gray-400 text-sm">
          {{ jobApplication.last_update }}
        </p>
      </div>
    </div>
  </div>
</template>
