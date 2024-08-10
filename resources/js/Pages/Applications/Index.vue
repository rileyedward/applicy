<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-between items-center">
        <h3>Your Applications</h3>

        <JobApplicationModal />
      </div>
    </div>
  </MainLayout>
</template>
