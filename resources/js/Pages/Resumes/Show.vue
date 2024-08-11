<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';
import BackArrowIcon from '@/Components/Icons/BackArrowIcon.vue';

const props = defineProps({
  resume: Object,
});

const pdfUrl = ref(
  route('resumes.view', props.resume.id) + '#navpanes=0&scrollbar=0'
);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div>
          <a
            :href="route('cover-letter.index')"
            class="text-neutral-300 hover:text-neutral-500 flex items-center mb-1"
          >
            <BackArrowIcon />
            Back to Resumes
          </a>
          <h3 class="text-xl font-semibold">Manage Resume</h3>

          <p class="text-neutral-500 mt-1 max-w-xl">
            Manage your resume template to use in your job hunt.
          </p>
        </div>

        <div class="pdf-viewer mt-8">
          <iframe
            v-if="pdfUrl"
            :src="pdfUrl"
            width="100%"
            height="600px"
            class="border-0"
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
