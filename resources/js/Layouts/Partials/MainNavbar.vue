<script setup>
import UserMenuDropdown from '@/Layouts/Partials/UserMenuDropdown.vue';
import { computed } from 'vue';
import NavbarLogo from '@/Components/Global/NavbarLogo.vue';

const isApplicationRoute = computed(() => {
  return window.location.pathname.includes('applications');
});

const isResumeRoute = computed(() => {
  return window.location.pathname.includes('resume');
});

const isCoverLetterRoute = computed(() => {
  return window.location.pathname.includes('cover-letter');
});
</script>

<template>
  <nav>
    <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-6">
      <div class="flex items-center gap-24">
        <NavbarLogo />

        <ul class="flex items-center gap-12">
          <li
            class="font-light text-sm hover:font-semibold hover:text-orange-500"
            :class="{ 'font-semibold text-orange-500': isApplicationRoute }"
          >
            <a :href="route('applications.index')"> Applications </a>
          </li>

          <li
            class="font-light text-sm hover:font-semibold hover:text-orange-500"
            :class="{ 'font-semibold text-orange-500': isResumeRoute }"
          >
            <a :href="route('resumes.index')"> Resumes </a>
          </li>

          <li
            class="font-light text-sm hover:font-semibold hover:text-orange-500"
            :class="{ 'font-semibold text-orange-500': isCoverLetterRoute }"
          >
            <a :href="route('cover-letter.index')"> Cover Letters </a>
          </li>
        </ul>
      </div>

      <div class="flex items-center gap-8">
        <UserMenuDropdown />
      </div>
    </div>
  </nav>
</template>
