<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UploadResume from '@/Pages/Resumes/Partials/UploadResume.vue';

defineProps({
  resumes: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div class="flex justify-between items-center mb-2">
          <h3 class="text-xl font-semibold">Resumes</h3>

          <UploadResume />
        </div>

        <p class="text-neutral-500 mt-1 max-w-xl">
          Manage all your resumes here that you wish to use for your job
          applications.
        </p>
      </div>
    </div>
  </MainLayout>
</template>
