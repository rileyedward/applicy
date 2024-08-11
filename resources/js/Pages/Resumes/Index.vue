<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div class="flex justify-between items-center mb-2">
          <h3 class="text-xl font-semibold">Resumes</h3>

          <SecondaryButton
            class="bg-orange-400 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
          >
            New
          </SecondaryButton>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
