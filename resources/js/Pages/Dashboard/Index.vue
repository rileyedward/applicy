<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
  applications: Array,
  favorites: Array,
});

const showFavorites = ref(false);

const filteredApplications = computed(() => {
  return showFavorites.value ? props.favorites : props.applications;
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
          <div class="flex justify-between items-center">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2">
              {{ showFavorites ? 'Favorites' : 'Actions Required' }}
            </h4>

            <div
              @click="showFavorites = !showFavorites"
              class="flex items-center cursor-pointer"
            >
              <span
                class="mr-2 text-sm font-medium text-gray-600 hidden md:inline-block"
              >
                {{ showFavorites ? 'Show All' : 'Show Favorites' }}
              </span>
              <div
                class="relative w-12 h-6 bg-blue-500 rounded-full transition-colors duration-300"
                :class="{ 'bg-green-500': showFavorites }"
              >
                <div
                  class="absolute w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300"
                  :class="{ 'translate-x-6': showFavorites }"
                ></div>
              </div>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table
              v-if="filteredApplications.length > 0"
              class="min-w-full bg-white border border-gray-200"
            >
              <thead>
                <tr class="bg-gray-100 text-left">
                  <th></th>
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
                  <td
                    class="px-2 py-4 border-b text-sm text-gray-700"
                    :class="
                      application.favorite ? 'text-yellow-500' : 'text-gray-400'
                    "
                  >
                    <svg
                      v-if="application.favorite"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-4 h-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.13 6.564a1 1 0 00.95.69h6.905c.969 0 1.371 1.24.588 1.81l-5.6 4.073a1 1 0 00-.364 1.118l2.13 6.564c.3.921-.755 1.688-1.54 1.118l-5.6-4.073a1 1 0 00-1.175 0l-5.6 4.073c-.785.57-1.84-.197-1.54-1.118l2.13-6.564a1 1 0 00-.364-1.118l-5.6-4.073c-.783-.57-.381-1.81.588-1.81h6.905a1 1 0 00.95-.69l2.13-6.564z"
                      />
                    </svg>
                    <svg
                      v-else
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-4 h-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.13 6.564a1 1 0 00.95.69h6.905c.969 0 1.371 1.24.588 1.81l-5.6 4.073a1 1 0 00-.364 1.118l2.13 6.564c.3.921-.755 1.688-1.54 1.118l-5.6-4.073a1 1 0 00-1.175 0l-5.6 4.073c-.785.57-1.84-.197-1.54-1.118l2.13-6.564a1 1 0 00-.364-1.118l-5.6-4.073c-.783-.57-.381-1.81.588-1.81h6.905a1 1 0 00.95-.69l2.13-6.564z"
                      />
                    </svg>
                  </td>
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
