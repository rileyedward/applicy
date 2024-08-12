<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpcomingInterviews from '@/Pages/Dashboard/Partials/UpcomingInterviews.vue';
import UpcomingReminders from '@/Pages/Dashboard/Partials/UpcomingReminders.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

defineProps({
  upcomingInterviews: Array,
  upcomingReminders: Array,
  hasApplications: Boolean,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12 flex flex-col md:flex-row gap-8">
      <div v-if="hasApplications">
        <div class="flex-1">
          <UpcomingInterviews :upcomingInterviews="upcomingInterviews" />
        </div>

        <div class="w-full md:w-1/3">
          <UpcomingReminders :upcomingReminders="upcomingReminders" />
        </div>
      </div>

      <div v-else class="max-w-3xl">
        <p class="text-neutral-300 font-bold">
          You have no outgoing applications at the moment. Start applying to
          jobs to see your upcoming interviews and reminders.
        </p>

        <a :href="route('applications.index')">
          <PrimaryButton class="bg-orange-500 hover:bg-orange-600 mt-4">
            Get Started
          </PrimaryButton>
        </a>
      </div>
    </div>
  </MainLayout>
</template>
