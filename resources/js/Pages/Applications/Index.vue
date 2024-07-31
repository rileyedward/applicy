<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SelectInput from '@/Components/SelectInput.vue';
import { ref, computed } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
  applications: Array,
});

const statusFilters = [
  {
    value: null,
    label: 'All',
  },
  {
    value: 'applied',
    label: 'Applied',
  },
  {
    value: 'in_review',
    label: 'In Review',
  },
  {
    value: 'coding_challenge',
    label: 'Coding Challenge',
  },
  {
    value: 'interview_scheduled',
    label: 'Interview Scheduled',
  },
  {
    value: 'interviewed',
    label: 'Interviewed',
  },
  {
    value: 'offer_extended',
    label: 'Offer Extended',
  },
  {
    value: 'offer_accepted',
    label: 'Offer Accepted',
  },
  {
    value: 'offer_declined',
    label: 'Offer Declined',
  },
  {
    value: 'rejected',
    label: 'Rejected',
  },
  {
    value: 'withdrawn',
    label: 'Withdrawn',
  },
];

const environmentFilters = [
  {
    value: null,
    label: 'All',
  },
  {
    value: 'remote',
    label: 'Remote',
  },
  {
    value: 'on-site',
    label: 'On-Site',
  },
  {
    value: 'hybrid',
    label: 'Hybrid',
  },
];

const statusSelection = ref(null);
const environmentSelection = ref(null);

const filteredApplications = computed(() => {
  let applications = props.applications;

  if (statusSelection.value !== null) {
    applications = applications.filter(
      (application) => application.status === statusSelection.value
    );
  }

  if (environmentSelection.value !== null) {
    applications = applications.filter(
      (application) => application.environment === environmentSelection.value
    );
  }

  return applications;
});
</script>

<template>
  <Head title="Applications - All" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Job Applications
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-start gap-4">
              <div>
                <InputLabel for="status" value="Status" />
                <SelectInput
                  id="status"
                  v-model="statusSelection"
                  :options="statusFilters"
                />
              </div>
              <div>
                <InputLabel for="environment" value="Environment" />
                <SelectInput
                  id="environment"
                  v-model="environmentSelection"
                  :options="environmentFilters"
                />
              </div>
            </div>
            <button
              @click.prevent="$inertia.visit(route('application.create'))"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
              Add +
            </button>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
              <thead>
                <tr class="bg-gray-100 text-left">
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Position
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Company Name
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Location
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Environment
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="application in filteredApplications"
                  :key="application.id"
                  class="hover:bg-gray-50 even:bg-gray-50 cursor-pointer"
                  @click.prevent="
                    $inertia.visit(route('application.show', application.id))
                  "
                >
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ application.position }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ application.company_name }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ application.location }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ application.environment }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ application.status }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
