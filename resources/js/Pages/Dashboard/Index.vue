<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpcomingInterviews from '@/Pages/Dashboard/Partials/UpcomingInterviews.vue';

defineProps({
  upcomingInterviews: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <UpcomingInterviews :upcomingInterviews="upcomingInterviews" />
      </div>
    </div>
  </MainLayout>
</template>
