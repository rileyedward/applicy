<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ApplicationHeader from '@/Pages/Applications/Index/Partials/ApplicationHeader.vue';
import ContactModal from '@/Pages/Applications/Show/Partials/ContactModal.vue';

defineProps({
  jobApplication: Object,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-between items-center">
        <ApplicationHeader :jobApplication="jobApplication" />
        <ContactModal :jobApplication="jobApplication" />
      </div>
    </div>
  </MainLayout>
</template>
