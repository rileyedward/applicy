<script setup>
import MainNavbar from '@/Layouts/Partials/MainNavbar.vue';
import MainNavbarMobile from '@/Layouts/Partials/MainNavbarMobile.vue';
import GlobalAlert from '@/Components/Global/GlobalAlert.vue';
</script>

<template>
  <div>
    <MainNavbar class="hidden md:block" />
    <MainNavbarMobile class="block md:hidden" />

    <main>
      <slot />
    </main>

    <GlobalAlert />
  </div>
</template>
