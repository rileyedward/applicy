<script setup>
import { ref } from 'vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import ProjectCard from '@/Pages/Profile/Partials/Projects/ProjectCard.vue';
import ProjectModal from '@/Pages/Profile/Partials/Projects/ProjectModal.vue';

defineProps({
  portfolioProjects: Array,
});

const showModal = ref(false);
const selectedPortfolioProject = ref(null);

const selectPortfolioProject = (project) => {
  selectedPortfolioProject.value = project;
  showModal.value = true;
};

const close = () => {
  selectedPortfolioProject.value = null;
  showModal.value = false;
};
</script>

<template>
  <ProjectModal
    :show="showModal"
    :selectedPortfolioProject="selectedPortfolioProject"
    @close="close"
  />

  <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-8">
    <div class="w-full bg-neutral-800 rounded-2xl p-6">
      <div class="w-full flex justify-between items-start">
        <div class="max-w-[225px] md:max-w-full">
          <h3 class="text-lg font-medium">Portfolio Projects</h3>
          <p class="mt-1 text-sm text-neutral-400 mb-6">
            Share some of your portfolio projects with us.
          </p>
        </div>

        <SecondaryButton @click.prevent="showModal = true">
          Add
        </SecondaryButton>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <ProjectCard
          v-for="portfolioProject in portfolioProjects"
          :key="portfolioProject.id"
          :portfolioProject="portfolioProject"
          @click.prevent="selectPortfolioProject(portfolioProject)"
        />
      </div>
    </div>
  </div>
</template>
