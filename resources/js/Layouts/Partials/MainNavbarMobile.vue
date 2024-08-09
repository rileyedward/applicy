<script setup>
import { ref } from 'vue';
import HamburgerMenuIcon from '@/Components/Icons/HamburgerMenuIcon.vue';
import LogoutIcon from '@/Components/Icons/LogoutIcon.vue';
import { useForm } from '@inertiajs/vue3';
import ProfileIcon from '@/Components/Icons/ProfileIcon.vue';
import JobIcon from '@/Components/Icons/JobIcon.vue';

const mobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

const logout = () => {
  useForm({}).delete(route('logout'));
};
</script>

<template>
  <nav class="relative flex justify-between items-center px-8 py-6 z-40">
    <div class="z-50">
      <h1
        class="text-2xl font-bold transition-colors ease-in-out"
        :class="{
          'text-white': !mobileMenuOpen,
          'text-black': mobileMenuOpen,
        }"
      >
        <a :href="route('dashboard')"> Applicy. </a>
      </h1>
    </div>

    <div class="z-50">
      <button @click.prevent="toggleMobileMenu">
        <HamburgerMenuIcon
          class="transition-colors ease-in-out"
          :class="{
            'text-white': !mobileMenuOpen,
            'text-black': mobileMenuOpen,
          }"
        />
      </button>
    </div>

    <div v-show="mobileMenuOpen" class="fixed inset-0 bg-white px-8 py-24">
      <ul class="flex flex-col gap-8">
        <li class="text-black font-normal hover:font-semibold">
          <a href="#" class="flex items-center gap-4">
            <JobIcon />
            <span>Applications</span>
          </a>
        </li>
      </ul>

      <hr class="border-1 border-gray-200 my-8" />

      <ul class="flex flex-col gap-8">
        <li class="text-black font-normal hover:font-semibold">
          <a :href="route('profile.index')" class="flex items-center gap-4">
            <ProfileIcon />
            <span>Profile</span>
          </a>
        </li>
        <li class="text-black font-normal hover:font-semibold">
          <button class="flex items-center gap-4" @click.prevent="logout">
            <LogoutIcon />
            <span>Logout</span>
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>
