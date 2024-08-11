<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ApplicationHeader from '@/Pages/Applications/Index/Partials/ApplicationHeader.vue';
import ViewToggle from '@/Pages/Applications/Show/Partials/ViewToggle.vue';
import ContactModal from '@/Pages/Applications/Show/Partials/ContactModal.vue';
import { ref } from 'vue';

defineProps({
  jobApplication: Object,
});

const showEditForm = ref(false);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-between items-center">
        <ApplicationHeader :jobApplication="jobApplication" />
        <div class="flex items-center gap-8">
          <ViewToggle
            :showEditForm="showEditForm"
            @toggleView="showEditForm = !showEditForm"
          />
          <ContactModal :jobApplication="jobApplication" />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
