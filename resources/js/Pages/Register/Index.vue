<script setup>
import RegistrationForm from '@/Pages/Register/Partials/RegistrationForm.vue';
</script>

<template>
  <div
    class="flex items-center justify-center min-h-screen px-4 bg-neutral-900 text-neutral-100"
  >
    <div class="bg-neutral-800 p-8 rounded-lg shadow-lg w-full max-w-3xl">
      <h1 class="text-4xl font-bold text-center text-neutral-100 mb-6">
        Applicy
      </h1>
      <p class="text-center text-neutral-400 mb-8">
        Register for an account to get started
      </p>

      <RegistrationForm />
    </div>
  </div>
</template>
