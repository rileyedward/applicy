<script setup>
import EducationCard from '@/Pages/Profile/Partials/Education/EducationCard.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';

defineProps({
  educationExperiences: Array,
});
</script>

<template>
  <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-12">
    <div class="w-full bg-neutral-800 rounded-2xl p-6">
      <div class="w-full flex justify-between items-center">
        <div>
          <h3 class="text-lg font-medium">Education Experience</h3>
          <p class="mt-1 text-sm text-neutral-400 mb-6">
            Add your education experience to your profile.
          </p>
        </div>

        <!-- TODO: Add education modal -->
        <SecondaryButton> Add Education </SecondaryButton>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <EducationCard
          v-for="educationExperience in educationExperiences"
          :key="educationExperience.id"
          :educationExperience="educationExperience"
        />
      </div>
    </div>
  </div>
</template>
