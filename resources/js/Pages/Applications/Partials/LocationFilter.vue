<script setup>
import { onMounted, ref, watch } from 'vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import CheckmarkIcon from '@/Components/Icons/CheckmarkIcon.vue';
import DownArrowIcon from '@/Components/Icons/DownArrowIcon.vue';

const props = defineProps({
  locationSelections: Array,
});

const emits = defineEmits(['updateSelectedLocations']);

const showPopup = ref(false);
const selectedFilters = ref([]);

onMounted(() => {
  window.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      showPopup.value = false;
    }
  });
});

watch(
  () => selectedFilters.value,
  (newValue) => {
    emits('updateSelectedLocations', newValue);
  }
);

const togglePopup = () => {
  showPopup.value = !showPopup.value;
};
</script>

<template>
  <div class="relative inline-block text-left">
    <SecondaryButton
      @click="togglePopup"
      class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
    >
      Location
      <span>
        <CheckmarkIcon v-if="selectedFilters.length > 0" />

        <DownArrowIcon v-else />
      </span>
    </SecondaryButton>

    <div
      v-if="showPopup"
      class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-neutral-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
    >
      <div class="py-1">
        <div
          v-for="(filter, index) in locationSelections"
          :key="index"
          class="flex items-center px-4 py-2"
        >
          <input
            type="checkbox"
            :id="index"
            :value="filter"
            v-model="selectedFilters"
            class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
          />
          <label :for="index" class="ml-2 block text-sm">
            {{ filter }}
          </label>
        </div>
      </div>
    </div>
  </div>
</template>
