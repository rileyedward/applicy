<script setup>
import JobApplicationModal from '@/Pages/Applications/Partials/JobApplicationModal.vue';
import NoApplications from '@/Pages/Applications/Partials/NoApplications.vue';
import LoadingSpinner from '@/Components/Icons/LoadingSpinner.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { computed, onMounted, ref, watch } from 'vue';
import Fuse from 'fuse.js';
import StatusFilter from '@/Pages/Applications/Partials/StatusFilter.vue';
import EnvironmentFilter from '@/Pages/Applications/Partials/EnvironmentFilter.vue';
import LocationFilter from '@/Pages/Applications/Partials/LocationFilter.vue';

const props = defineProps({
  environmentSelections: Array,
  statusSelections: Array,
  locationSelections: Array,
});

const loading = ref(true);
const search = ref('');
const applications = ref([]);
const selectedEnvironments = ref([]);
const selectedStatuses = ref([]);
const selectedLocations = ref([]);

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
        locations:
          selectedLocations.value.length === 0 ? null : selectedLocations.value,
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

watch([selectedEnvironments, selectedStatuses, selectedLocations], () => {
  retrieveApplications();
});

const fuseOptions = {
  keys: ['company_name', 'position'],
  threshold: 0.3,
};

const filteredApplications = computed(() => {
  if (search.value && search.value.length >= 3) {
    const fuse = new Fuse(applications.value, fuseOptions);
    const items = fuse.search(search.value);
    return items.map((item) => item.item);
  }

  return applications.value;
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
          <TextInput
            v-model="search"
            placeholder="Search for a job..."
            class="w-full max-w-72 block bg-neutral-700 border-none"
          />

          <StatusFilter
            :statusSelections="statusSelections"
            @updateSelectedStatuses="selectedStatuses = $event"
          />

          <LocationFilter
            :locationSelections="locationSelections"
            @updateSelectedLocations="selectedLocations = $event"
          />

          <EnvironmentFilter
            :environmentSelections="environmentSelections"
            @updateSelectedEnvironments="selectedEnvironments = $event"
          />
        </div>

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
