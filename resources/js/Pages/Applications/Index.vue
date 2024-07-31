<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  applications: Array,
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
          <div class="flex justify-end mb-4">
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
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
