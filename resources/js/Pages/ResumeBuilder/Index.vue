<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <a :href="route('profile.edit')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Profile
        </h2>
      </a>
    </template>
  </AuthenticatedLayout>
</template>
