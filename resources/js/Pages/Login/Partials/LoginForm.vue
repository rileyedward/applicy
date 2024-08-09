<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

const form = useForm({
  email: '',
  password: '',
});

const submit = () => {
  form.post(route('login.store'));
};
</script>

<template>
  <form @submit.prevent="submit" class="space-y-6">
    <div class="w-full">
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

    <div class="w-full">
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

    <div class="flex items-center gap-4 justify-end">
      <a :href="route('register.index')">
        <SecondaryButton class="text-neutral-400 hover:text-neutral-100">
          Need an account?
        </SecondaryButton>
      </a>

      <PrimaryButton
        type="submit"
        :disabled="form.processing"
        class="bg-orange-600 hover:bg-orange-500"
      >
        Login
      </PrimaryButton>
    </div>
  </form>
</template>
