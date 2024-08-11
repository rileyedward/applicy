<script setup>
import BackArrowIcon from '@/Components/Icons/BackArrowIcon.vue';

defineProps({
  jobApplication: Object,
});
</script>

<template>
  <div class="cursor-pointer">
    <a
      :href="route('applications.index')"
      class="text-neutral-300 hover:text-neutral-500 flex items-center"
    >
      <BackArrowIcon />
      Back to Applications
    </a>
    <a :href="jobApplication.job_url" target="_blank">
      <h3 class="text-2xl font-semibold mt-1 hover:underline">
        {{ jobApplication.position }}
      </h3>
    </a>
    <a :href="jobApplication.company_url" target="_blank">
      <h4 class="text-lg font-semibold text-orange-500 hover:underline">
        @{{ jobApplication.company_name }}
      </h4>
    </a>
  </div>
</template>

<style scoped></style>
