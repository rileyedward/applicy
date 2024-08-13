<script setup>
import NavbarLogo from '@/Components/Global/NavbarLogo.vue';
</script>

<template>
  <nav>
    <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-6">
      <NavbarLogo />

      <a
        class="bg-orange-600 text-white text-sm px-6 py-1 rounded-md font-semibold hover:bg-orange-700"
        :href="route('dashboard')"
      >
        Dashboard
      </a>
    </div>
  </nav>
</template>
