<script setup>
import AddEducation from '@/Pages/ResumeBuilder/Partials/AddEducation.vue';
import { ref } from 'vue';
import EducationSettings from '@/Pages/ResumeBuilder/Partials/EducationSettings.vue';

defineProps({
  educationExperiences: Array,
});

const selectedExperience = ref(null);
const showSettings = ref(false);
</script>

<template>
  <section>
    <header class="flex justify-between items-center">
      <div>
        <h2 class="text-lg font-medium text-gray-900">Education</h2>
        <p class="mt-1 text-sm text-gray-600">
          Add your educational background.
        </p>
      </div>
      <AddEducation />
    </header>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="experience in educationExperiences"
        :key="experience.id"
        class="p-4 bg-gray-100 rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer"
        @click="
          selectedExperience = experience;
          showSettings = true;
        "
      >
        <h3 class="text-lg font-medium text-gray-900">
          {{ experience.degree }}
        </h3>
        <p class="mt-1 text-sm text-gray-600">
          {{ experience.field_of_study }}
        </p>
        <p class="mt-1 text-sm text-gray-600">
          {{ experience.institution_name }} - {{ experience.location }}
        </p>
      </div>
    </div>
  </section>

  <EducationSettings
    :modalOpen="showSettings"
    :experience="selectedExperience"
    @close="showSettings = false"
  />
</template>
