<script setup>
import { ref } from 'vue';
import ProjectSettings from '@/Pages/ResumeBuilder/Partials/ProjectSettings.vue';
import AddProject from '@/Pages/ResumeBuilder/Partials/AddProject.vue';

defineProps({
  portfolioProjects: Array,
});

const selectedExperience = ref(null);
const showSettings = ref(false);
</script>

<template>
  <section>
    <header class="flex justify-between items-center">
      <div>
        <h2 class="text-lg font-medium text-gray-900">Projects</h2>
        <p class="mt-1 text-sm text-gray-600">Add to your portfolio.</p>
      </div>
      <AddProject />
    </header>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="experience in portfolioProjects"
        :key="experience.id"
        class="p-4 bg-gray-100 rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer"
        @click="
          selectedExperience = experience;
          showSettings = true;
        "
      >
        <h3 class="text-lg font-medium text-gray-900">
          {{ experience.project_name }}
        </h3>
        <p class="mt-1 text-sm text-gray-600 truncate">
          {{ experience.description }}
        </p>
      </div>
    </div>
  </section>

  <ProjectSettings
    :modalOpen="showSettings"
    :experience="selectedExperience"
    @close="showSettings = false"
  />
</template>
