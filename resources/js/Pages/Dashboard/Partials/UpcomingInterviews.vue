<script setup>
import InterviewBanner from '@/Pages/Dashboard/Partials/InterviewBanner.vue';

defineProps({
  upcomingInterviews: Array,
});
</script>

<template>
  <div>
    <div>
      <h3 class="text-lg font-semibold text-neutral-100">
        Upcoming Interviews
      </h3>

      <p class="text-neutral-500 mt-1 max-w-xl mb-4">
        <span v-if="upcomingInterviews.length > 0">
          Here are your upcoming interviews. Good luck!
        </span>
        <span v-else> You have no upcoming interviews. </span>
      </p>
    </div>

    <div class="space-y-6">
      <InterviewBanner
        v-for="interview in upcomingInterviews"
        :key="interview.id"
        :interview="interview"
      />
    </div>
  </div>
</template>
