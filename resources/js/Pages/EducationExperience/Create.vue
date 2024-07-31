<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
</script>

<template>
  <Head title="Experience - New" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Education
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form
            @submit.prevent="form.post(route('education-experience.store'))"
          >
            <div>
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

            <div class="mt-4">
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

            <div class="mt-4">
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

              <InputError
                class="mt-2"
                :message="form.errors.institution_name"
              />
            </div>

            <div class="mt-4">
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

            <div class="mt-4">
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

            <div class="mt-4">
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
      </div>
    </div>
  </AuthenticatedLayout>
</template>
