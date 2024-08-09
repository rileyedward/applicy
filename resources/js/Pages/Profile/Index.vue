<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpdateProfile from '@/Pages/Profile/Partials/UpdateProfile.vue';
import EducationWrapper from '@/Pages/Profile/Partials/Education/EducationWrapper.vue';

defineProps({
  educationExperiences: Array,
});
</script>

<template>
  <MainLayout>
    <UpdateProfile />
    <EducationWrapper :educationExperiences="educationExperiences" />
  </MainLayout>
</template>
