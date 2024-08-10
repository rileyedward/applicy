<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';

defineProps({
  environmentSelections: Array,
  statusSelections: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-end items-center">
        <JobApplicationModal
          :environmentSelections="environmentSelections"
          :statusSelections="statusSelections"
        />
      </div>
    </div>
  </MainLayout>
</template>
