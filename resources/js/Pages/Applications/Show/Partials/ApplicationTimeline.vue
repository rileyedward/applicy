<script setup>
import TimelineBanner from '@/Pages/Applications/Show/Partials/TimelineBanner.vue';
import NewTimeline from '@/Pages/Applications/Show/Partials/NewTimeline.vue';
import TimelineDotsIcon from '@/Components/Icons/TimelineDotsIcon.vue';

defineProps({
  jobApplication: Object,
});
</script>

<template>
  <div class="max-w-4xl">
    <!-- Header -->
    <div>
      <h3 class="text-2xl font-semibold text-neutral-100 mb-1">
        Application Timeline
      </h3>
      <p class="text-lg text-neutral-300">
        Track the progress of your application from start to finish.
      </p>
    </div>

    <!-- Timeline -->
    <div class="space-y-3 py-8">
      <NewTimeline />

      <div v-for="action in jobApplication.actions" :key="action.id">
        <TimelineDotsIcon class="my-4" />

        <TimelineBanner :action="action" :jobApplication="jobApplication" />
      </div>
    </div>
  </div>
</template>
