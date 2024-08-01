<script setup>
import { ref } from 'vue';
import UpdateApplicationAction from '@/Pages/Applications/Partials/UpdateApplicationAction.vue';

defineProps({
  application: Object,
  statusFilters: Array,
});

const updateModalOpen = ref(false);
const selectedAction = ref(null);

const openUpdateModal = (action) => {
  selectedAction.value = action;
  updateModalOpen.value = true;
};
</script>

<template>
  <UpdateApplicationAction
    :updateModalOpen="updateModalOpen"
    :application="application"
    :action="selectedAction"
    :statusFilters="statusFilters"
    @closeModal="updateModalOpen = false"
  />
  <div class="w-full flex flex-col gap-4">
    <div
      v-for="action in application.actions"
      :key="action.id"
      class="p-6 bg-white shadow-sm sm:rounded-lg cursor-pointer hover:bg-gray-50 hover:shadow-2xl"
      @click.prevent="openUpdateModal(action)"
    >
      <div
        class="flex flex-col md:flex-row justify-between items-center text-center md:text-left"
      >
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
      <p
        v-if="action.notes"
        class="text-gray-600 mt-2 text-center md:text-left"
      >
        {{ action.notes }}
      </p>
    </div>
  </div>
</template>
