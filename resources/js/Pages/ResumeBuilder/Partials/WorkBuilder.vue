<script setup>
import AddWork from '@/Pages/ResumeBuilder/Partials/AddWork.vue';
import WorkSettings from '@/Pages/ResumeBuilder/Partials/WorkSettings.vue';
import { ref } from 'vue';

defineProps({
  workExperiences: Array,
});

const selectedExperience = ref(null);
const showSettings = ref(false);
</script>

<template>
  <section>
    <header class="flex justify-between items-center">
      <div>
        <h2 class="text-lg font-medium text-gray-900">Work</h2>
        <p class="mt-1 text-sm text-gray-600">
          Add your professional background.
        </p>
      </div>
      <AddWork />
    </header>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="experience in workExperiences"
        :key="experience.id"
        class="p-4 bg-gray-100 rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer"
        @click="
          selectedExperience = experience;
          showSettings = true;
        "
      >
        <h3 class="text-lg font-medium text-gray-900">
          {{ experience.position }}
        </h3>
        <p class="mt-1 text-sm text-gray-600">
          {{ experience.company_name }} - {{ experience.location }}
        </p>
      </div>
    </div>
  </section>

  <WorkSettings
    :modalOpen="showSettings"
    :experience="selectedExperience"
    @close="showSettings = false"
  />
</template>
