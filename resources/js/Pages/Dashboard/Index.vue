<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  needToApply: Array,
  interviewScheduled: Array,
  offeredExtended: Array,
});

const applicationTypes = [
  {
    label: 'Need to Apply',
    value: 'needToApply',
  },
  {
    label: 'Interview Scheduled',
    value: 'interviewScheduled',
  },
  {
    label: 'Offered Extended',
    value: 'offeredExtended',
  },
];

const applicationTypeSelected = ref('interviewScheduled');

const applications = computed(() => {
  if (applicationTypeSelected.value === 'needToApply') {
    return props.needToApply;
  }

  if (applicationTypeSelected.value === 'interviewScheduled') {
    return props.interviewScheduled;
  }

  if (applicationTypeSelected.value === 'offeredExtended') {
    return props.offeredExtended;
  }
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
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
                  v-model="applicationTypeSelected"
                  :options="applicationTypes"
                />
              </div>
            </div>
          </div>
          <div class="overflow-x-auto">
            <table
              v-if="applications.length > 0"
              class="min-w-full bg-white border border-gray-200"
            >
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
                  v-for="application in applications"
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

            <div v-else>
              <p class="text-center text-gray-500">No applications found.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
