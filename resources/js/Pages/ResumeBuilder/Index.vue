<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EducationBuilder from '@/Pages/ResumeBuilder/Partials/EducationBuilder.vue';
import ProjectsBuilder from '@/Pages/ResumeBuilder/Partials/ProjectsBuilder.vue';
import WorkBuilder from '@/Pages/ResumeBuilder/Partials/WorkBuilder.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  educationExperiences: Array,
  workExperiences: Array,
  portfolioProjects: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Resume Builder" />

    <template #header>
      <div class="flex justify-between items-center gap-8">
        <a :href="route('resume-builder.index')">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resume
          </h2>
        </a>

        <a :href="route('profile.edit')">
          <PrimaryButton> Manage Profile </PrimaryButton>
        </a>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <EducationBuilder :educationExperiences="educationExperiences" />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <WorkBuilder :workExperiences="workExperiences" />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <ProjectsBuilder :portfolioProjects="portfolioProjects" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
