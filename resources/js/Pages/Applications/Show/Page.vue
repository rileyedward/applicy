<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ApplicationHeader from '@/Pages/Applications/Index/Partials/ApplicationHeader.vue';
import ViewToggle from '@/Pages/Applications/Show/Partials/ViewToggle.vue';
import ContactModal from '@/Pages/Applications/Show/Partials/ContactModal.vue';
import { ref } from 'vue';
import EditApplicationForm from '@/Pages/Applications/Show/Partials/EditApplicationForm.vue';
import ApplicationTimeline from '@/Pages/Applications/Show/Partials/ApplicationTimeline.vue';

defineProps({
  jobApplication: Object,
  environmentSelections: Array,
  statusSelections: Array,
  locationSelections: Array,
});

const showEditForm = ref(false);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-between items-center">
        <ApplicationHeader :jobApplication="jobApplication" />
        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-8">
          <ViewToggle
            :showEditForm="showEditForm"
            @toggleView="showEditForm = !showEditForm"
          />
          <ContactModal :jobApplication="jobApplication" />
        </div>
      </div>

      <div class="py-12">
        <EditApplicationForm
          v-if="showEditForm"
          :jobApplication="jobApplication"
          :environmentSelections="environmentSelections"
          :statusSelections="statusSelections"
        />

        <ApplicationTimeline v-else :jobApplication="jobApplication" />
      </div>
    </div>
  </MainLayout>
</template>
