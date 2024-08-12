<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';

defineProps({
  coverLetterTemplates: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl">
        <div class="flex justify-between items-center mb-2">
          <h3 class="text-xl font-semibold">Cover Letters</h3>

          <a :href="route('cover-letter.create')">
            <SecondaryButton
              class="bg-orange-400 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
            >
              New
            </SecondaryButton>
          </a>
        </div>

        <p class="text-neutral-500 mt-1 max-w-xl">
          Manage your cover letter letters you wish to use as templates.
        </p>

        <div class="mt-8 space-y-3">
          <div
            v-for="coverLetter in coverLetterTemplates"
            :key="coverLetter.id"
            class="bg-neutral-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 hover:scale-105 cursor-pointer"
          >
            <a :href="route('cover-letter.show', coverLetter.id)">
              <h4 class="text-lg font-semibold">
                {{ coverLetter.title }}
              </h4>
              <p class="text-sm text-orange-500 mt-1">
                {{ new Date(coverLetter.created_at).toLocaleDateString() }}
              </p>

              <p class="text-neutral-500 mt-1 truncate-lines">
                {{ coverLetter.body }}
              </p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped>
.truncate-lines {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2; /* Change this number to show more or fewer lines */
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
