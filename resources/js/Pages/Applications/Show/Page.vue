<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ApplicationHeader from '@/Pages/Applications/Index/Partials/ApplicationHeader.vue';

defineProps({
  jobApplication: Object,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <ApplicationHeader :jobApplication="jobApplication" />
    </div>
  </MainLayout>
</template>
