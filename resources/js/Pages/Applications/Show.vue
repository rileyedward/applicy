<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ApplicationDetails from '@/Pages/Applications/Partials/ApplicationDetails.vue';
import StatusBadge from '@/Pages/Applications/Partials/StatusBadge.vue';
import { ref } from 'vue';
import ApplicationProgress from '@/Pages/Applications/Partials/ApplicationProgress.vue';

const props = defineProps({
  application: Object,
  statusFilters: Array,
});

const showForm = ref(false);

const form = useForm({
  job_url: props.application?.job_url ?? '',
  position: props.application?.position ?? '',
  company_name: props.application?.company_name ?? '',
  location: props.application?.location ?? '',
  environment: props.application?.environment.toLowerCase() ?? '',
  description: props.application?.description ?? '',
  contact_name: props.application?.contact_name ?? '',
  contact_email: props.application?.contact_email ?? '',
  contact_phone: props.application?.contact_phone ?? '',
});

const environments = [
  { value: 'remote', label: 'Remote' },
  { value: 'on-site', label: 'On-Site' },
  { value: 'hybrid', label: 'Hybrid' },
];

const removeApplication = () => {
  if (confirm('Are you sure you want to delete this application?')) {
    useForm({}).delete(route('application.destroy', props.application.id));
  }
};
</script>

<template>
  <Head title="Job Application - Settings" />

  <AuthenticatedLayout>
    <template #header>
      <a :href="route('application.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Job Applications
        </h2>
      </a>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
          <a :href="application.job_url">
            <h3 class="font-semibold text-2xl">
              {{ application.position }}
            </h3>
            <h4 class="text-lg text-slate-500">
              {{ application.company_name }} - {{ application.location }}
            </h4>
          </a>

          <div class="flex flex-col md:flex-row items-center gap-4">
            <SecondaryButton @click.prevent="showForm = !showForm">
              {{ showForm ? 'Actions' : 'Edit' }}
            </SecondaryButton>

            <StatusBadge
              :application="application"
              :statusFilters="statusFilters"
            />
          </div>
        </div>

        <div
          class="flex flex-col md:flex-row justify-between items-start gap-8"
        >
          <ApplicationDetails :application="application" />

          <div class="w-full">
            <h3 class="font-semibold text-lg mb-4">
              {{ showForm ? 'Edit Application' : 'Application Progress' }}
            </h3>

            <div
              v-if="showForm"
              class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
            >
              <form
                @submit.prevent="
                  form.put(route('application.update', application.id))
                "
              >
                <div>
                  <InputLabel for="job_url" value="Job URL" />
                  <TextInput
                    id="job_url"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.job_url"
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
                    autocomplete="company_name"
                  />
                  <InputError
                    class="mt-2"
                    :message="form.errors.company_name"
                  />
                </div>

                <div class="mt-4">
                  <InputLabel for="location" value="Location" />
                  <TextInput
                    id="location"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.location"
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
                  />
                  <InputError class="mt-2" :message="form.errors.environment" />
                </div>

                <div class="mt-4">
                  <InputLabel for="description" value="Description" />
                  <TextArea
                    id="description"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    autocomplete="description"
                  />
                  <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <hr class="my-8" />
                <h3 class="font-semibold text-lg mt-8">Contact Information</h3>

                <div class="mt-4">
                  <InputLabel for="contact_name" value="Contact Name" />
                  <TextInput
                    id="contact_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.contact_name"
                    autocomplete="contact_name"
                  />
                  <InputError
                    class="mt-2"
                    :message="form.errors.contact_name"
                  />
                </div>

                <div class="mt-4">
                  <InputLabel for="contact_email" value="Contact Email" />
                  <TextInput
                    id="contact_email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.contact_email"
                    autocomplete="contact_email"
                  />
                  <InputError
                    class="mt-2"
                    :message="form.errors.contact_email"
                  />
                </div>

                <div class="mt-4">
                  <InputLabel for="contact_phone" value="Contact Phone" />
                  <TextInput
                    id="contact_phone"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.contact_phone"
                    autocomplete="contact_phone"
                  />
                  <InputError
                    class="mt-2"
                    :message="form.errors.contact_phone"
                  />
                </div>

                <div class="flex items-center justify-end gap-4 mt-4">
                  <SecondaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.prevent="removeApplication"
                  >
                    Remove
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

            <ApplicationProgress
              v-else
              :application="application"
              :statusFilters="statusFilters"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
