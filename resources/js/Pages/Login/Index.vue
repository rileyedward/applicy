<script setup>
import LoginForm from '@/Pages/Login/Partials/LoginForm.vue';
</script>

<template>
  <div
    class="flex items-center justify-center min-h-screen px-4 bg-neutral-900 text-neutral-100"
  >
    <div class="bg-neutral-800 p-8 rounded-lg shadow-lg w-full max-w-xl">
      <h1 class="text-4xl font-bold text-center text-orange-600 mb-6">
        Applicy
      </h1>
      <p class="text-center text-neutral-400 mb-8">
        Login or register for an account to get started
      </p>

      <LoginForm />
    </div>
  </div>
</template>
