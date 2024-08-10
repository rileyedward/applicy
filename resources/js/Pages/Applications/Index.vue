<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';
import { computed, onMounted, ref, watch } from 'vue';
import NoApplications from '@/Pages/Applications/Partials/NoApplications.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import Fuse from 'fuse.js';

defineProps({
  environmentSelections: Array,
  statusSelections: Array,
});

const loading = ref(true);
const search = ref('');
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

const fuseOptions = {
  keys: ['company_name', 'position'],
  threshold: 0.3,
};

const filteredApplications = computed(() => {
  if (search.value && search.value.length >= 3) {
    const fuse = new Fuse(applications.value, fuseOptions);
    return fuse.search(search.value);
  }

  return applications.value;
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-end items-center">
        <JobApplicationModal
          :environmentSelections="environmentSelections"
          :statusSelections="statusSelections"
          @refreshApplications="retrieveApplications"
        />
      </div>

      <div class="py-12">
        <LoadingSpinner v-if="loading" />

        <div v-else>
          <div v-if="applications.length > 0">
            <div
              v-for="application in filteredApplications"
              :key="application.id"
            >
              {{ application.position }} - {{ application.company_name }}
            </div>
          </div>

          <NoApplications v-else />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
