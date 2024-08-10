<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref } from 'vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';

const props = defineProps({
  environmentSelections: Array,
  statusSelections: Array,
});

const emits = defineEmits(['refreshApplications']);

const showModal = ref(false);

const form = useForm({
  status: props.statusSelections[0].value,
  job_url: '',
  position: '',
  company_name: '',
  location: '',
  environment: props.environmentSelections[0].value,
  salary_range: '',
  contact_name: '',
  contact_email: '',
  contact_phone: '',
  description: '',
  notes: '',
});

const submit = () => {
  form.post(route('applications.store'), {
    preserveScroll: true,
    onSuccess: () => {
      emits('refreshApplications');
      showModal.value = false;
      form.reset();
    },
  });
};
</script>

<template>
  <div>
    <SecondaryButton
      @click.prevent="showModal = true"
      class="bg-orange-400 hover:bg-orange-600 w-full sm:w-fit flex justify-center"
    >
      New
    </SecondaryButton>
    <Modal :show="showModal" @close="showModal = false" maxWidth="6xl">
      <div class="p-6">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">
          New Job Application
        </h3>
        <p class="text-sm text-neutral-300 mb-6">
          Please fill out the form below to apply for this job.
        </p>

        <form @submit.prevent="submit" class="space-y-6">
          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="status" value="Application Status" />
              <SelectInput
                v-model="form.status"
                :options="statusSelections"
                id="status"
                class="mt-1 block w-full bg-neutral-700 border-none"
              />
              <InputError :message="form.errors.status" class="mt-1" />
            </div>

            <div class="flex-1">
              <InputLabel for="job_url" value="Job URL" />
              <TextInput
                v-model="form.job_url"
                id="job_url"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="https://monsterinc.com/careers"
              />
              <InputError :message="form.errors.job_url" class="mt-1" />
            </div>
          </div>

          <hr class="border-neutral-600 my-6" />

          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="position" value="Position" />
              <TextInput
                v-model="form.position"
                id="position"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="Software Engineer"
              />
              <InputError :message="form.errors.position" class="mt-1" />
            </div>
            <div class="flex-1">
              <InputLabel for="company_name" value="Company Name" />
              <TextInput
                v-model="form.company_name"
                id="company_name"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="Monster Inc."
              />
              <InputError :message="form.errors.company_name" class="mt-1" />
            </div>
          </div>

          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="location" value="Location" />
              <TextInput
                v-model="form.location"
                id="location"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="San Francisco, CA"
              />
              <InputError :message="form.errors.location" class="mt-1" />
            </div>
            <div class="flex-1">
              <InputLabel for="environment" value="Environment" />
              <SelectInput
                v-model="form.environment"
                :options="environmentSelections"
                id="environment"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="Remote"
              />
              <InputError :message="form.errors.environment" class="mt-1" />
            </div>
          </div>

          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="salary_range" value="Salary Range" />
              <TextInput
                v-model="form.salary_range"
                id="salary_range"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="$100,000 - $120,000"
              />
              <InputError :message="form.errors.salary_range" class="mt-1" />
            </div>

            <div class="flex-1" />
          </div>

          <hr class="border-neutral-600 my-6" />

          <div>
            <h5 class="font-medium text-neutral-100 mb-1">
              Contact Information
            </h5>

            <p class="text-sm text-neutral-300 mb-6">
              Please provide the contact information for the person you are in
              touch with at the company.
            </p>
          </div>

          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="contact_name" value="Contact Name" />
              <TextInput
                v-model="form.contact_name"
                id="contact_name"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="Mike Wazowski"
              />
              <InputError :message="form.errors.contact_name" class="mt-1" />
            </div>

            <div class="flex-1">
              <InputLabel for="contact_phone" value="Contact Phone" />
              <TextInput
                v-model="form.contact_phone"
                id="contact_phone"
                type="text"
                class="mt-1 block w-full bg-neutral-700 border-none"
                placeholder="Optional..."
              />
              <InputError :message="form.errors.contact_phone" class="mt-1" />
            </div>
          </div>

          <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="contact_email" value="Contact Email" />
              <TextInput
                v-model="form.contact_email"
                id="contact_email"
                type="email"
                class="mt-1 block w-full bg-neutral-700 border-none"
              />
              <InputError :message="form.errors.contact_email" class="mt-1" />
            </div>

            <div class="flex-1" />
          </div>

          <hr class="border-neutral-600 my-6" />

          <div>
            <h5 class="font-medium text-neutral-100 mb-1">
              Additional Information
            </h5>

            <p class="text-sm text-neutral-300 mb-6">
              Please provide any additional information about the job
              application.
            </p>
          </div>

          <div class="w-full">
            <InputLabel for="description" value="Description" />
            <TextArea
              v-model="form.description"
              id="description"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.description" class="mt-1" />
          </div>

          <div class="w-full">
            <InputLabel for="notes" value="Notes" />
            <TextArea
              v-model="form.notes"
              id="notes"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.notes" class="mt-1" />
          </div>

          <div class="flex justify-end">
            <PrimaryButton
              type="submit"
              :disabled="form.processing"
              class="bg-orange-600 hover:bg-orange-500"
            >
              Save
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>
