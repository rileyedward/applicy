<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';
import { onMounted, ref, watch } from 'vue';

defineProps({
  environmentSelections: Array,
  statusSelections: Array,
});

const applications = ref([]);
const selectedEnvironments = ref([]);
const selectedStatuses = ref([]);

const retrieveApplications = () => {
  axios
    .get(route('applications.search'), {
      params: {
        environments:
          selectedEnvironments.value.length === 0
            ? null
            : selectedEnvironments.value,
        statuses:
          selectedStatuses.value.length === 0 ? null : selectedStatuses.value,
      },
    })
    .then((response) => {
      applications.value = response?.data || [];
    });
};

onMounted(() => {
  retrieveApplications();
});

watch([selectedEnvironments.value, selectedStatuses.value], () => {
  retrieveApplications();
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
