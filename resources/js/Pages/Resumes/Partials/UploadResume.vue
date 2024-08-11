<script setup>
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import { ref } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';

const showModal = ref(false);

const form = useForm({
  title: '',
  file: null,
});

const submit = () => {
  alert('testing');
};
</script>

<template>
  <!-- Upload Resume -->
  <div>
    <SecondaryButton
      @click="showModal = true"
      class="bg-orange-400 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
    >
      Upload
    </SecondaryButton>

    <Modal v-model:show="showModal" @close="showModal = false">
      <div class="p-6">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">
          Upload Your Resume
        </h3>
        <p class="text-sm text-neutral-300 mb-6">
          Upload and save your resume to your profile.
        </p>

        <form @submit.prevent="submit">
          <div class="mb-4">
            <InputLabel for="title" value="Title" />
            <TextInput
              v-model="form.title"
              id="title"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.title" />
          </div>

          <div class="mb-4">
            <InputLabel for="file" value="Upload File" />
            <TextInput
              v-model="form.file"
              id="file"
              type="file"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
          </div>

          <div class="flex justify-end">
            <SecondaryButton
              type="submit"
              class="bg-orange-400 hover:bg-orange-600"
            >
              Upload
            </SecondaryButton>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>
