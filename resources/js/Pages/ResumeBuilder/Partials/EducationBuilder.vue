<script setup>
import AddEducation from '@/Pages/ResumeBuilder/Partials/AddEducation.vue';

defineProps({
  educationExperiences: Array,
});
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
  </section>
</template>
