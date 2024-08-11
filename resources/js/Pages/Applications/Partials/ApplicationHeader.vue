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
    <h3 class="text-2xl font-semibold mt-1">{{ jobApplication.position }},</h3>
    <h4 class="text-lg font-semibold text-orange-500">
      @{{ jobApplication.company_name }}
    </h4>
  </div>
</template>

<style scoped></style>
