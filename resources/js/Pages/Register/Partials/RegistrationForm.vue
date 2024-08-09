<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

const form = useForm({
  first_name: '',
  middle_name: '',
  last_name: '',
  email: '',
  phone_number: '',
  location: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register.store'));
};
</script>

<template>
  <form @submit.prevent="submit" class="space-y-6">
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

    <div class="flex flex-col lg:flex-row gap-4">
      <div class="flex-1">
        <InputLabel for="password" value="Password" />
        <TextInput
          v-model="form.password"
          id="password"
          type="password"
          class="mt-1 block w-full bg-neutral-700 border-none"
          placeholder="********"
        />
        <InputError :message="form.errors.password" class="mt-1" />
      </div>
      <div class="flex-1">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput
          v-model="form.password_confirmation"
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full bg-neutral-700 border-none"
          placeholder="********"
        />
        <InputError :message="form.errors.password_confirmation" class="mt-1" />
      </div>
    </div>

    <div class="flex items-center gap-4 justify-end">
      <a :href="route('login')">
        <SecondaryButton class="text-neutral-400 hover:text-neutral-100">
          Already registered?
        </SecondaryButton>
      </a>

      <PrimaryButton
        type="submit"
        :disabled="form.processing"
        class="bg-orange-600 hover:bg-orange-500"
      >
        Register
      </PrimaryButton>
    </div>
  </form>
</template>
