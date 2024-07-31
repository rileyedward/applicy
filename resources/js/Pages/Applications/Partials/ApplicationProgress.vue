<script setup>
import { computed } from 'vue';

const props = defineProps({
  application: Object,
});
</script>

<template>
  <div class="w-full">
    <div
      v-for="action in application.actions"
      :key="action.id"
      class="p-6 bg-white shadow-sm sm:rounded-lg"
    >
      <div class="flex justify-between items-center">
        <div class="mb-4">
          <p class="text-gray-800">
            {{ new Date(action.created_at).toLocaleDateString() }}
          </p>
          <h4 class="text-2xl font-semibold">
            {{ action.title ?? `Application is now ${action.new_status}` }}
          </h4>
        </div>

        <div class="flex items-center space-x-4">
          <span
            class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-gray-300 text-gray-900"
          >
            {{ action.previous_status }}
          </span>
          <span class="text-gray-500">→</span>
          <span
            class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-orange-300 text-orange-900"
          >
            {{ action.new_status }}
          </span>
        </div>
      </div>
      <p v-if="action.notes" class="text-gray-600 mt-2">
        {{ action.notes }}
      </p>
    </div>
  </div>
</template>
