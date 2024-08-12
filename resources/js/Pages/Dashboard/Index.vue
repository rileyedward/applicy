<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpcomingInterviews from '@/Pages/Dashboard/Partials/UpcomingInterviews.vue';

defineProps({
  upcomingInterviews: Array,
  upcomingReminders: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <UpcomingInterviews :upcomingInterviews="upcomingInterviews" />

        <div>
          {{ JSON.stringify(upcomingReminders) }}
        </div>
      </div>
    </div>
  </MainLayout>
</template>
