<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import BackArrowIcon from '@/Components/Icons/BackArrowIcon.vue';

const form = useForm({
  title: '',
  body: '',
});

const submit = () => {
  form.post(route('cover-letter.store'), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 py-12">
      <div class="max-w-4xl bg-neutral-800 p-6 rounded-lg shadow-lg">
        <div>
          <a
            :href="route('cover-letter.index')"
            class="text-neutral-300 hover:text-neutral-500 flex items-center mb-1"
          >
            <BackArrowIcon />
            Back to Cover Letters
          </a>
          <h3 class="text-xl font-semibold">New Cover Letter</h3>

          <p class="text-neutral-500 mt-1 max-w-xl">
            Create a new cover letter template to use in your job hunt.
          </p>
        </div>

        <form @submit.prevent="submit" class="space-y-6 mt-8">
          <div class="w-full">
            <InputLabel for="title" value="Template Title" />
            <TextInput
              v-model="form.title"
              id="title"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Cover Letter Template"
            />
            <InputError :message="form.errors.title" class="mt-1" />
          </div>

          <div class="w-full">
            <InputLabel for="body" value="Template Body" />
            <TextArea
              v-model="form.body"
              id="body"
              class="mt-1 block w-full bg-neutral-700 border-none"
              :rows="12"
              placeholder="Dear Hiring Manager,"
            />
            <InputError :message="form.errors.body" class="mt-1" />
          </div>

          <div class="flex justify-end">
            <PrimaryButton
              type="submit"
              class="bg-orange-500 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
            >
              Save
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </MainLayout>
</template>
