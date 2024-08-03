<script setup>
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const showModal = ref(false);

const form = useForm({
  project_name: '',
  description: '',
  skills: '',
});

const submit = () => {
  form.post(route('portfolio-project.store'), {
    onSuccess: () => {
      showModal.value = false;
      form.reset();
    },
  });
};
</script>

<template>
  <SecondaryButton @click.prevent="showModal = true"> + New </SecondaryButton>

  <Modal :show="showModal" @close="showModal = false">
    <div>
      <h2 class="text-lg font-medium text-gray-900 mb-1">Add Project</h2>

      <p class="mt-1 text-sm text-gray-600 mb-4">
        Add to your portfolio projects.
      </p>

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="project_name" value="Project Name" />

          <TextInput
            id="project_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.project_name"
            required
            autofocus
            autocomplete="project_name"
          />

          <InputError class="mt-2" :message="form.errors.project_name" />
        </div>

        <div class="mt-4">
          <InputLabel for="description" value="Description" />

          <TextArea
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
            required
            autofocus
            autocomplete="description"
          />

          <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div class="mt-4">
          <InputLabel for="skills" value="Skills" />

          <TextArea
            id="skills"
            type="text"
            class="mt-1 block w-full"
            v-model="form.skills"
            required
            autofocus
            autocomplete="skills"
          />

          <InputError class="mt-2" :message="form.errors.skills" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
