<script setup>
import UserMenuDropdown from '@/Layouts/Partials/UserMenuDropdown.vue';
</script>

<template>
  <nav>
    <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-6">
      <div class="flex items-center gap-24">
        <h1 class="text-2xl font-bold">
          <a :href="route('dashboard')"> Applicy. </a>
        </h1>

        <ul class="flex items-center gap-12">
          <li
            class="font-light text-sm hover:font-semibold hover:text-orange-500"
          >
            <a href="#"> Applications </a>
          </li>
        </ul>
      </div>

      <div class="flex items-center gap-8">
        <UserMenuDropdown />
      </div>
    </div>
  </nav>
</template>
