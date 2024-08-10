<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';
import { onMounted, ref, watch } from 'vue';
import NoApplications from '@/Pages/Applications/Partials/NoApplications.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';

defineProps({
  environmentSelections: Array,
  statusSelections: Array,
});

const loading = ref(true);
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
      loading.value = false;
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

      <div class="py-12">
        <LoadingSpinner v-if="loading" />

        <div v-else>
          <div v-if="applications.length > 0">Applications</div>

          <NoApplications v-else />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
