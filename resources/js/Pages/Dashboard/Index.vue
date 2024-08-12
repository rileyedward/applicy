<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpcomingInterviews from '@/Pages/Dashboard/Partials/UpcomingInterviews.vue';
import UpcomingReminders from '@/Pages/Dashboard/Partials/UpcomingReminders.vue';

defineProps({
  upcomingInterviews: Array,
  upcomingReminders: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12 flex flex-col md:flex-row gap-8">
      <div class="flex-1">
        <UpcomingInterviews :upcomingInterviews="upcomingInterviews" />
      </div>

      <div class="w-full md:w-1/3">
        <UpcomingReminders :upcomingReminders="upcomingReminders" />
      </div>
    </div>
  </MainLayout>
</template>
