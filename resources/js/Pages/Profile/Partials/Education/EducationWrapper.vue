<script setup>
import EducationCard from '@/Pages/Profile/Partials/Education/EducationCard.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import { ref } from 'vue';
import EducationModal from '@/Pages/Profile/Partials/Education/EducationModal.vue';

defineProps({
  educationExperiences: Array,
});

const showModal = ref(false);
const selectedEducationExperience = ref(null);

const selectEducationExperience = (educationExperience) => {
  selectedEducationExperience.value = educationExperience;
  showModal.value = true;
};

const close = () => {
  selectedEducationExperience.value = null;
  showModal.value = false;
};
</script>

<template>
  <EducationModal
    :show="showModal"
    :selectedEducationExperience="selectedEducationExperience"
    @close="close"
  />

  <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-8">
    <div class="w-full bg-neutral-800 rounded-2xl p-6">
      <div class="w-full flex justify-between items-start">
        <div class="max-w-[225px] md:max-w-full">
          <h3 class="text-lg font-medium">Education Experience</h3>
          <p class="mt-1 text-sm text-neutral-400 mb-6">
            Add your education experience to your profile.
          </p>
        </div>

        <SecondaryButton @click.prevent="showModal = true">
          Add
        </SecondaryButton>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <EducationCard
          v-for="educationExperience in educationExperiences"
          :key="educationExperience.id"
          :educationExperience="educationExperience"
          @click.prevent="selectEducationExperience(educationExperience)"
        />
      </div>
    </div>
  </div>
</template>
