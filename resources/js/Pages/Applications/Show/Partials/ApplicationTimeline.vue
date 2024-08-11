<script setup>
import TimelineBanner from '@/Pages/Applications/Show/Partials/TimelineBanner.vue';
import NewTimeline from '@/Pages/Applications/Show/Partials/NewTimeline.vue';
import TimelineDotsIcon from '@/Components/Icons/TimelineDotsIcon.vue';
import { ref } from 'vue';

defineProps({
  jobApplication: Object,
  actions: Array,
  statusSelections: Array,
});

const detailedView = ref(false);
</script>

<template>
  <div class="max-w-5xl">
    <!-- Timeline -->
    <div class="space-y-3">
      <NewTimeline
        :jobApplication="jobApplication"
        :statusSelections="statusSelections"
        @toggleDetailedView="detailedView = !detailedView"
      />

      <div v-for="action in actions" :key="action.id">
        <TimelineDotsIcon class="my-4" />

        <TimelineBanner
          :action="action"
          :jobApplication="jobApplication"
          :statusSelections="statusSelections"
          :detailedView="detailedView"
        />
      </div>
    </div>
  </div>
</template>
