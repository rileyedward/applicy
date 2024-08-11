<script setup>
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import { ref } from 'vue';
import ProfessionalCard from '@/Pages/Profile/Partials/Professional/ProfessionalCard.vue';
import ProfessionalModal from '@/Pages/Profile/Partials/Professional/ProfessionalModal.vue';

defineProps({
  professionalExperiences: Array,
});

const showModal = ref(false);
const selectedProfessionalExperience = ref(null);

const selectProfessionalExperience = (professionalExperience) => {
  selectedProfessionalExperience.value = professionalExperience;
  showModal.value = true;
};

const close = () => {
  selectedProfessionalExperience.value = null;
  showModal.value = false;
};
</script>

<template>
  <ProfessionalModal
    :show="showModal"
    :selectedProfessionalExperience="selectedProfessionalExperience"
    @close="close"
  />

  <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-8">
    <div class="w-full bg-neutral-800 rounded-2xl p-6">
      <div class="w-full flex justify-between items-start">
        <div class="max-w-[225px] md:max-w-full">
          <h3 class="text-lg font-medium">Professional Experience</h3>
          <p class="mt-1 text-sm text-neutral-400 mb-6">
            Give us some insight into your professional experience.
          </p>
        </div>

        <SecondaryButton @click.prevent="showModal = true">
          Add
        </SecondaryButton>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <ProfessionalCard
          v-for="professionalExperience in professionalExperiences"
          :key="professionalExperience.id"
          :professionalExperience="professionalExperience"
          @click.prevent="selectProfessionalExperience(professionalExperience)"
        />
      </div>
    </div>
  </div>
</template>
