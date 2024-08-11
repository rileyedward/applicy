<script setup>
import UpdateAction from '@/Pages/Applications/Show/Partials/UpdateAction.vue';
import { ref } from 'vue';

const props = defineProps({
  action: Object,
  jobApplication: Object,
  statusSelections: Array,
  detailedView: Boolean,
});

const showModal = ref(false);
</script>

<template>
  <div>
    <UpdateAction
      :show="showModal"
      :action="action"
      :jobApplication="jobApplication"
      :statusSelections="statusSelections"
      @close="showModal = false"
    />
    <div
      @click.prevent="showModal = true"
      class="p-4 md:p-6 bg-neutral-800 rounded-md shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer"
    >
      <div class="flex justify-between items-center">
        <div class="w-full md:w-1/2">
          <p class="text-xs text-gray-400 font-semibold">
            {{ new Date(action.created_at).toLocaleDateString() }}
          </p>
          <h2 class="text-sm md:text-base font-semibold text-white">
            {{ action.title }}
          </h2>
        </div>

        <div
          class="w-full flex flex-col justify-between items-center text-sm space-y-2 md:items-end"
        >
          <div
            class="px-3 py-1 font-semibold rounded-full text-white bg-green-500 text-center"
          >
            {{ action.new_status_pretty }}
          </div>
          <p class="text-gray-400 text-center md:text-right">
            {{ action.last_update }}
          </p>
        </div>
      </div>

      <transition name="fade" mode="in-out">
        <hr
          v-if="detailedView && action.notes"
          class="my-2 border-neutral-700"
        />
      </transition>

      <transition name="fade" mode="in-out">
        <p v-if="detailedView && action.notes" class="text-sm text-gray-400">
          {{ action.notes }}
        </p>
      </transition>
    </div>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
