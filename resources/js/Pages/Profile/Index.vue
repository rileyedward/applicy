<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpdateProfile from '@/Pages/Profile/Partials/UpdateProfile.vue';
import EducationWrapper from '@/Pages/Profile/Partials/Education/EducationWrapper.vue';
import ProfessionalWrapper from '@/Pages/Profile/Partials/Professional/ProfessionalWrapper.vue';
import ProjectWrapper from '@/Pages/Profile/Partials/Projects/ProjectWrapper.vue';

defineProps({
  educationExperiences: Array,
  professionalExperiences: Array,
  portfolioProjects: Array,
});
</script>

<template>
  <MainLayout>
    <UpdateProfile />
    <EducationWrapper :educationExperiences="educationExperiences" />
    <ProfessionalWrapper :professionalExperiences="professionalExperiences" />
    <ProjectWrapper :portfolioProjects="portfolioProjects" />
  </MainLayout>
</template>
