<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const form = useForm({
  job_url: '',
  position: '',
  company_name: '',
  location: '',
  environment: '',
  description: '',
});

const environments = [
  { value: 'remote', label: 'Remote' },
  { value: 'on-site', label: 'On-Site' },
  { value: 'hybrid', label: 'Hybrid' },
];
</script>

<template>
  <Head title="Job Application - New" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Job Application
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="form.post(route('application.store'))">
            <div>
              <InputLabel for="job_url" value="Job URL" />
              <TextInput
                id="job_url"
                type="url"
                class="mt-1 block w-full"
                v-model="form.job_url"
                required
                autocomplete="job_url"
              />
              <InputError class="mt-2" :message="form.errors.job_url" />
            </div>

            <div class="mt-4">
              <InputLabel for="position" value="Position" />
              <TextInput
                id="position"
                type="text"
                class="mt-1 block w-full"
                v-model="form.position"
                required
                autocomplete="position"
              />
              <InputError class="mt-2" :message="form.errors.position" />
            </div>

            <div class="mt-4">
              <InputLabel for="company_name" value="Company Name" />
              <TextInput
                id="company_name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.company_name"
                required
                autocomplete="company_name"
              />
              <InputError class="mt-2" :message="form.errors.company_name" />
            </div>

            <div class="mt-4">
              <InputLabel for="location" value="Location" />
              <TextInput
                id="location"
                type="text"
                class="mt-1 block w-full"
                v-model="form.location"
                required
                autocomplete="location"
              />
              <InputError class="mt-2" :message="form.errors.location" />
            </div>

            <div class="mt-4">
              <InputLabel for="environment" value="Work Environment" />
              <SelectInput
                id="environment"
                class="mt-1 block w-full"
                v-model="form.environment"
                :options="environments"
                required
                autocomplete="environment"
              />
              <InputError class="mt-2" :message="form.errors.environment" />
            </div>

            <div class="mt-4">
              <InputLabel for="description" value="Description" />
              <TextArea
                id="description"
                class="mt-1 block w-full"
                v-model="form.description"
                required
                autocomplete="description"
              />
              <InputError class="mt-2" :message="form.errors.description" />
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
