<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SelectInput from '@/Components/SelectInput.vue';
import { ref, computed } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Fuse from 'fuse.js';

const props = defineProps({
  applications: Array,
  statusFilters: Array,
  environmentFilters: Array,
  locationFilters: Array,
});

const statusSelection = ref(null);
const environmentSelection = ref(null);
const locationSelection = ref(null);
const search = ref(null);

const fuseOptions = {
  keys: ['position', 'company_name', 'location', 'environment', 'status'],
  threshold: 0.3,
};

const filteredApplications = computed(() => {
  let applications = props.applications;

  if (statusSelection.value !== null) {
    applications = applications.filter(
      (application) =>
        application.status.toLowerCase() === statusSelection.value
    );
  }

  if (environmentSelection.value !== null) {
    applications = applications.filter(
      (application) =>
        application.environment.toLowerCase() === environmentSelection.value
    );
  }

  if (locationSelection.value !== null) {
    applications = applications.filter(
      (application) => application.location === locationSelection.value
    );
  }

  if (search.value !== null && search.value !== '') {
    const fuse = new Fuse(applications, fuseOptions);

    applications = fuse.search(search.value).map((result) => result.item);
  }

  return applications;
});
</script>

<template>
  <Head title="Applications - All" />

  <AuthenticatedLayout>
    <template #header>
      <a :href="route('application.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Job Applications
        </h2>
      </a>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-start gap-4">
              <div>
                <InputLabel for="search" value="Search" />
                <TextInput id="search" type="text" v-model="search" />
              </div>
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
              <div>
                <InputLabel for="location" value="Location" />
                <SelectInput
                  id="location"
                  v-model="locationSelection"
                  :options="locationFilters"
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
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Interview Date
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Last Update
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
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{
                      application.interview_date
                        ? new Date(
                            application.interview_date
                          ).toLocaleDateString()
                        : null
                    }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ new Date(application.updated_at).toLocaleDateString() }}
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
