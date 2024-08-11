<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UploadResume from '@/Pages/Resumes/Partials/UploadResume.vue';
import DownloadIcon from '@/Components/Icons/DownloadIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  resumes: Array,
});

const downloadResume = (resume) => {
  useForm({}).get(route('resumes.download', resume.id));
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div class="flex justify-between items-center mb-2">
          <h3 class="text-xl font-semibold">Resumes</h3>

          <UploadResume />
        </div>

        <p class="text-neutral-500 mt-1 max-w-xl">
          Manage all your resumes here that you wish to use for your job
          applications.
        </p>

        <div
          v-for="resume in resumes"
          :key="resume.id"
          class="bg-neutral-800 shadow rounded-lg p-4 mt-8 hover:shadow-lg transition duration-300 hover:scale-105 cursor-pointer"
        >
          <a
            :href="route('resumes.show', resume.id)"
            class="flex justify-between items-center"
          >
            <div>
              <h4 class="text-lg font-semibold">{{ resume.title }}</h4>
              <p class="text-neutral-500">
                {{ new Date(resume.created_at).toLocaleDateString() }}
              </p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
