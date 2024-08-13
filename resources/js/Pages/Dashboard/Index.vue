<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UpcomingInterviews from '@/Pages/Dashboard/Partials/UpcomingInterviews.vue';
import UpcomingReminders from '@/Pages/Dashboard/Partials/UpcomingReminders.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import RecentActivity from '@/Pages/Dashboard/Partials/RecentActivity.vue';

defineProps({
  recentActivity: Array,
  upcomingInterviews: Array,
  upcomingReminders: Array,
  hasApplications: Boolean,
});
</script>

<template>
  <MainLayout>
    <div
      v-if="hasApplications"
      class="max-w-6xl mx-auto px-8 py-12 flex flex-col-reverse md:flex-row gap-8"
    >
      <div class="flex-1 space-y-12">
        <UpcomingInterviews
          v-if="upcomingInterviews.length > 0"
          :upcomingInterviews="upcomingInterviews"
        />

        <hr v-if="upcomingInterviews.length > 0" class="border-neutral-500" />

        <RecentActivity :recentActivity="recentActivity" />
      </div>

      <div class="w-full md:w-1/3 space-y-12">
        <UpcomingReminders :upcomingReminders="upcomingReminders" />

        <hr class="block md:hidden border-neutral-500" />
      </div>
    </div>

    <div v-else class="max-w-6xl mx-auto px-8 py-12 gap-8">
      <div class="max-w-3xl">
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
