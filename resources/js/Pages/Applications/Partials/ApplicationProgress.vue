<script setup>
defineProps({
  application: Object,
});
</script>

<template>
  <div class="w-full">
    <h3 class="font-semibold text-lg">Application Progress</h3>

    <div
      v-for="action in application.actions"
      :key="action.id"
      class="p-6 bg-white shadow-sm sm:rounded-lg mt-4"
    >
      {{ action }}
    </div>
  </div>
</template>
