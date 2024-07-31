<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  educationExperiences: Array,
});
</script>

<template>
  <Head title="Education - All" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Education
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-end mb-4">
            <button
              @click.prevent="
                $inertia.visit(route('education-experience.create'))
              "
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
                    Degree
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Field of Study
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Institution Name
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Location
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    Start Date
                  </th>
                  <th
                    class="px-6 py-3 border-b text-sm font-medium text-gray-600"
                  >
                    End Date
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="experience in educationExperiences"
                  :key="experience.id"
                  class="hover:bg-gray-50 even:bg-gray-50 cursor-pointer"
                  @click.prevent="
                    $inertia.visit(
                      route('education-experience.show', experience.id)
                    )
                  "
                >
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ experience.degree }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ experience.field_of_study }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ experience.institution_name }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ experience.location }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ new Date(experience.start_date).toLocaleDateString() }}
                  </td>
                  <td class="px-6 py-4 border-b text-sm text-gray-700">
                    {{ new Date(experience.end_date).toLocaleDateString() }}
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
