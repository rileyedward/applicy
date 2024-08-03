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
  degree: props.experience?.degree ?? '',
  field_of_study: props.experience?.field_of_study ?? '',
  institution_name: props.experience?.institution_name ?? '',
  location: props.experience?.location ?? '',
  start_date: props.experience?.start_date ?? '',
  end_date: props.experience?.end_date ?? '',
  description: props.experience?.description ?? '',
  skills: props.experience?.skills ?? '',
});

watch(
  () => props.experience,
  (value) => {
    form.degree = value?.degree ?? '';
    form.field_of_study = value?.field_of_study ?? '';
    form.institution_name = value?.institution_name ?? '';
    form.location = value?.location ?? '';
    form.start_date = value?.start_date ?? '';
    form.end_date = value?.end_date ?? '';
    form.description = value?.description ?? '';
    form.skills = value?.skills ?? '';
  }
);

const submit = () => {
  form.put(route('education-experience.update', props.experience.id), {
    onSuccess: () => {
      emits('close');
      form.reset();
    },
  });
};

const removeEducation = () => {
  if (confirm('Are you sure you want to delete this education experience?')) {
    form.delete(route('education-experience.destroy', props.experience.id), {
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
        <div class="flex flex-col md:flex-row gap-4 w-full">
          <div class="w-full">
            <InputLabel for="degree" value="Degree" />

            <TextInput
              id="degree"
              type="text"
              class="mt-1 block w-full"
              v-model="form.degree"
              required
              autofocus
              autocomplete="degree"
            />

            <InputError class="mt-2" :message="form.errors.degree" />
          </div>

          <div class="w-full">
            <InputLabel for="field_of_study" value="Field of Study" />

            <TextInput
              id="field_of_study"
              type="text"
              class="mt-1 block w-full"
              v-model="form.field_of_study"
              required
              autofocus
              autocomplete="field_of_study"
            />

            <InputError class="mt-2" :message="form.errors.field_of_study" />
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 w-full mt-4">
          <div class="w-full">
            <InputLabel for="institution_name" value="Institution Name" />

            <TextInput
              id="institution_name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.institution_name"
              required
              autofocus
              autocomplete="institution_name"
            />

            <InputError class="mt-2" :message="form.errors.institution_name" />
          </div>

          <div class="w-full">
            <InputLabel for="location" value="Location" />

            <TextInput
              id="location"
              type="text"
              class="mt-1 block w-full"
              v-model="form.location"
              required
              autofocus
              autocomplete="location"
            />

            <InputError class="mt-2" :message="form.errors.location" />
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 w-full mt-4">
          <div class="w-full">
            <InputLabel for="start_date" value="Start Date" />

            <TextInput
              id="start_date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.start_date"
              required
              autofocus
              autocomplete="start_date"
            />

            <InputError class="mt-2" :message="form.errors.start_date" />
          </div>

          <div class="w-full">
            <InputLabel for="end_date" value="End Date" />

            <TextInput
              id="end_date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.end_date"
              required
              autofocus
              autocomplete="end_date"
            />

            <InputError class="mt-2" :message="form.errors.end_date" />
          </div>
        </div>

        <div class="mt-4">
          <InputLabel for="description" value="Tell a bit more..." />

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
          <InputLabel for="skills" value="List some skills you learned..." />

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
            @click.prevent="removeEducation"
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
