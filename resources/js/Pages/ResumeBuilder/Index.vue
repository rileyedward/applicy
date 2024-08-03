<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EducationBuilder from '@/Pages/ResumeBuilder/Partials/EducationBuilder.vue';
import ExperienceBuilder from '@/Pages/ResumeBuilder/Partials/ExperienceBuilder.vue';
import ProjectsBuilder from '@/Pages/ResumeBuilder/Partials/ProjectsBuilder.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Resume Builder" />

    <template #header>
      <a :href="route('profile.edit')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Profile
        </h2>
      </a>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <EducationBuilder />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <ExperienceBuilder />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <ProjectsBuilder />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
