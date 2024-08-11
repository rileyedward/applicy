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
    <div
      class="flex flex-col-reverse gap-4 md:flex-row justify-between items-start md:items-center"
    >
      <!-- Position and Company Info -->
      <div class="mb-4 md:mb-0">
        <h2 class="text-xl font-semibold text-white">
          {{ jobApplication.position }}
        </h2>
        <p class="text-lg text-gray-400">
          {{ jobApplication.company_name }}
        </p>
      </div>

      <!-- Status and Last Update -->
      <div
        class="w-full flex flex-row md:flex-col justify-between items-center md:items-end text-sm space-y-2"
      >
        <div
          class="px-3 py-1 font-semibold rounded-full text-white bg-green-500 text-center"
        >
          {{ jobApplication.status_pretty }}
        </div>
        <p class="text-gray-400 text-center md:text-right">
          {{ jobApplication.last_update }}
        </p>
      </div>
    </div>
  </div>
</template>
