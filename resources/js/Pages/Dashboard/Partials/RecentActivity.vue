<script setup>
import ActivityBanner from '@/Pages/Dashboard/Partials/ActivityBanner.vue';

defineProps({
  recentActivity: Array,
});
</script>

<template>
  <div>
    <div>
      <h3 class="text-lg font-semibold text-neutral-100">Recent Activity</h3>

      <p class="text-neutral-500 mt-1 max-w-xl mb-4">
        <span v-if="recentActivity.length > 0">
          Here are your recent activities. Keep it up!
        </span>
        <span v-else> You have no recent activity. </span>
      </p>
    </div>

    <div class="space-y-4">
      <ActivityBanner
        v-for="activity in recentActivity"
        :key="activity.id"
        :activity="activity"
      />
    </div>
  </div>
</template>
