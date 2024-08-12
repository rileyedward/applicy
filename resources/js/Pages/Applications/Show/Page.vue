<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ApplicationHeader from '@/Pages/Applications/Index/Partials/ApplicationHeader.vue';
import ViewToggle from '@/Pages/Applications/Show/Partials/ViewToggle.vue';
import ContactModal from '@/Pages/Applications/Show/Partials/ContactModal.vue';
import { ref } from 'vue';
import EditApplicationForm from '@/Pages/Applications/Show/Partials/EditApplicationForm.vue';
import ApplicationTimeline from '@/Pages/Applications/Show/Partials/ApplicationTimeline.vue';
import Reminder from '@/Pages/Applications/Show/Partials/Reminder.vue';
import ApplicationAssistant from '@/Pages/Applications/Show/Partials/ApplicationAssistant.vue';

defineProps({
  jobApplication: Object,
  actions: Array,
  environmentSelections: Array,
  statusSelections: Array,
  locationSelections: Array,
  coverLetterTemplateSelections: Array,
  resumeSelections: Array,
  reminder: Object,
});

const showEditForm = ref(false);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <Reminder :reminder="reminder" class="mb-4" />

      <div
        class="flex flex-col-reverse md:flex-row justify-between items-center"
      >
        <div class="w-full">
          <ApplicationHeader :jobApplication="jobApplication" />
        </div>
        <div
          class="flex justify-between md:justify-end items-center gap-2 md:gap-4 w-full mb-4 md:mb-0"
        >
          <ViewToggle
            :showEditForm="showEditForm"
            @toggleView="showEditForm = !showEditForm"
          />
          <ContactModal :jobApplication="jobApplication" />
          <ApplicationAssistant
            :jobApplication="jobApplication"
            :coverLetterTemplateSelections="coverLetterTemplateSelections"
            :resumeSelections="resumeSelections"
          />
        </div>
      </div>

      <div class="py-12">
        <EditApplicationForm
          v-if="showEditForm"
          :jobApplication="jobApplication"
          :environmentSelections="environmentSelections"
          :statusSelections="statusSelections"
        />

        <ApplicationTimeline
          v-else
          :jobApplication="jobApplication"
          :actions="actions"
          :statusSelections="statusSelections"
        />
      </div>
    </div>
  </MainLayout>
</template>
