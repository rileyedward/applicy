<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';
import BackArrowIcon from '@/Components/Icons/BackArrowIcon.vue';
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import ResumeAssistant from '@/Pages/Resumes/Partials/ResumeAssistant.vue';

const props = defineProps({
  resume: Object,
});

const pdfUrl = ref(
  route('resumes.view', props.resume.id) + '#navpanes=0&scrollbar=0'
);

const removeResume = () => {
  if (confirm('Are you sure you want to delete this resume?')) {
    useForm({}).delete(route('resumes.destroy', props.resume.id));
  }
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div>
          <div
            class="flex flex-col-reverse md:flex-row justify-between items-start md:items-center"
          >
            <div class="w-full">
              <a
                :href="route('resumes.index')"
                class="text-neutral-300 hover:text-neutral-500 flex items-center mb-1"
              >
                <BackArrowIcon />
                Back to Resumes
              </a>
              <h3 class="text-xl font-semibold">
                {{ resume.title }}
              </h3>
            </div>

            <div
              class="flex justify-between md:justify-end items-center gap-8 w-full my-4 md:my-0"
            >
              <SecondaryButton @click.prevent="removeResume">
                Remove
              </SecondaryButton>

              <ResumeAssistant :resume="resume" />
            </div>
          </div>

          <p class="text-neutral-500 mt-1 max-w-xl">
            Manage and view your resume.
          </p>
        </div>

        <div class="pdf-viewer mt-8">
          <iframe
            v-if="pdfUrl"
            :src="pdfUrl"
            width="100%"
            height="600px"
            class="border-0 bg-neutral-800 p-4 shadow-md rounded-2xl"
          />
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<style>
.pdf-viewer {
  width: 100%;
  height: 600px;
  overflow: hidden;
}
</style>
