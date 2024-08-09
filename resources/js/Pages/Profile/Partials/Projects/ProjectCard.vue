<script setup>
defineProps({
  portfolioProject: Object,
});
</script>

<template>
  <div
    class="p-4 bg-neutral-700 rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer"
  >
    <h3 class="text-lg font-medium">
      {{ portfolioProject.name }}
    </h3>
    <p class="mt-1 text-sm truncate">
      {{ portfolioProject.description }}
    </p>
  </div>
</template>
