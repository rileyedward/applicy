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
  degree: '',
  field_of_study: '',
  institution_name: '',
  location: '',
  start_date: '',
  end_date: '',
  description: '',
  skills: '',
});

const submit = () => {
  form.post(route('education-experience.store'), {
    onSuccess: () => {
      showModal.value = false;
      form.reset();
    },
  });
};
</script>

<template>
  <SecondaryButton @click.prevent="showModal = true">
    + Education
  </SecondaryButton>

  <Modal :show="showModal" @close="showModal = false">
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
