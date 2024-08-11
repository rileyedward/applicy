<script setup>
import TimelineBanner from '@/Pages/Applications/Show/Partials/TimelineBanner.vue';
import NewTimeline from '@/Pages/Applications/Show/Partials/NewTimeline.vue';
import TimelineDotsIcon from '@/Components/Icons/TimelineDotsIcon.vue';

defineProps({
  jobApplication: Object,
  actions: Array,
  statusSelections: Array,
});
</script>

<template>
  <div class="max-w-4xl">
    <!-- Timeline -->
    <div class="space-y-3">
      <NewTimeline
        :jobApplication="jobApplication"
        :statusSelections="statusSelections"
      />

      <div v-for="action in actions" :key="action.id">
        <TimelineDotsIcon class="my-4" />

        <TimelineBanner
          :action="action"
          :jobApplication="jobApplication"
          :statusSelections="statusSelections"
        />
      </div>
    </div>
  </div>
</template>
