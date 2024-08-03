<script setup>
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  modalOpen: Boolean,
  experience: Array,
});

const emits = defineEmits(['close']);

const form = useForm({
  project_name: props.experience?.project_name ?? '',
  description: props.experience?.description ?? '',
  skills: props.experience?.skills ?? '',
});

watch(
  () => props.experience,
  (value) => {
    form.project_name = value?.project_name ?? '';
    form.description = value?.description ?? '';
    form.skills = value?.skills ?? '';
  }
);

const submit = () => {
  form.put(route('portfolio-project.update', props.experience.id), {
    onSuccess: () => {
      emits('close');
      form.reset();
    },
  });
};

const removeProject = () => {
  if (confirm('Are you sure you want to delete this portfolio project?')) {
    form.delete(route('portfolio-project.destroy', props.experience.id), {
      onSuccess: () => {
        emits('close');
        form.reset();
      },
    });
  }
};
</script>

<template>
  <Modal :show="modalOpen" @close="$emit('close')">
    <div>
      <h2 class="text-lg font-medium text-gray-900 mb-1">Add Education</h2>

      <p class="mt-1 text-sm text-gray-600 mb-4">
        Add to your educational background.
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

        <div class="flex justify-end items-center gap-4 mt-4">
          <SecondaryButton
            @click.prevent="removeProject"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete
          </SecondaryButton>

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
