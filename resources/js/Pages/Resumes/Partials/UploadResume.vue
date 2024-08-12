<script setup>
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import { ref } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import FileUploadIcon from '@/Components/Icons/FileUploadIcon.vue';

const showModal = ref(false);

const form = useForm({
  title: '',
  file: null,
});

const handleFileChange = (event) => {
  form.file = event.target.files[0];
};

const submit = () => {
  form.post(route('resumes.store'), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      showModal.value = false;
    },
  });
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
            <InputLabel
              for="file"
              value="Upload File"
              class="mb-2 block text-sm font-medium text-neutral-300"
            />
            <div class="flex items-center justify-center w-full">
              <label
                for="file"
                class="flex flex-col items-center justify-center w-full h-32 bg-neutral-800 rounded-lg cursor-pointer hover:bg-neutral-700 transition"
              >
                <FileUploadIcon :fileUploaded="form.file" />
                <input
                  id="file"
                  type="file"
                  class="hidden"
                  @change="handleFileChange"
                />
                <p v-if="form.file" class="text-xs text-neutral-400">
                  {{ form.title }}
                </p>
                <InputError :message="form.errors.file" />
              </label>
            </div>
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
