<script setup>
import GuestNavbar from '@/Layouts/Partials/GuestNavbar.vue';
</script>

<template>
  <div>
    <GuestNavbar />

    <main>
      <slot />
    </main>
  </div>
</template>
