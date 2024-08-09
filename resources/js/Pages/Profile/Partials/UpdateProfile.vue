<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

const user = usePage().props.auth.user;

const form = useForm({
  first_name: user?.first_name ?? '',
  middle_name: user?.middle_name ?? '',
  last_name: user?.last_name ?? '',
  email: user?.email ?? '',
  phone_number: user?.phone_number ?? '',
  location: user?.location ?? '',
});

const submit = () => {
  form.put(route('profile.update'), {
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-12">
    <div class="w-full bg-neutral-800 rounded-2xl p-6">
      <h3 class="text-lg font-medium">Profile Information</h3>
      <p class="mt-1 text-sm text-neutral-400 mb-6">
        Update your account's profile information and email address.
      </p>

      <form @submit.prevent="submit" class="max-w-2xl space-y-6">
        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="first_name" value="First Name" />
            <TextInput
              v-model="form.first_name"
              id="first_name"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Master"
            />
            <InputError :message="form.errors.first_name" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="middle_name" value="Middle Name" />
            <TextInput
              v-model="form.middle_name"
              id="middle_name"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Optional..."
            />
            <InputError :message="form.errors.middle_name" class="mt-1" />
          </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="last_name" value="Last Name" />
            <TextInput
              v-model="form.last_name"
              id="last_name"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Chief"
            />
            <InputError :message="form.errors.last_name" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="email" value="Email" />
            <TextInput
              v-model="form.email"
              id="email"
              type="email"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="masterchief@cortana.com"
            />
            <InputError :message="form.errors.email" class="mt-1" />
          </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="phone_number" value="Phone Number" />
            <TextInput
              v-model="form.phone_number"
              id="phone_number"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="1171176969"
            />
            <InputError :message="form.errors.phone_number" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="location" value="Location" />
            <TextInput
              v-model="form.location"
              id="location"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Eridanus II"
            />
            <InputError :message="form.errors.location" class="mt-1" />
          </div>
        </div>

        <div>
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
  </div>
</template>
