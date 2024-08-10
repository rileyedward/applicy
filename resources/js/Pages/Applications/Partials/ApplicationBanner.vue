<script setup>
defineProps({
  jobApplication: Object,
});
</script>

<template>
  <div class="p-6 bg-neutral-800 rounded-md shadow-md">
    <div class="flex justify-between items-start mb-4">
      <div>
        <h2 class="text-xl font-bold text-white">
          {{ jobApplication.position }}
        </h2>
        <p class="text-gray-400">{{ jobApplication.company_name }}</p>
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
