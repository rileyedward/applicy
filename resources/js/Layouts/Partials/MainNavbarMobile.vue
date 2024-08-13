<script setup>
import { ref } from 'vue';
import HamburgerMenuIcon from '@/Components/Icons/HamburgerMenuIcon.vue';
import LogoutIcon from '@/Components/Icons/LogoutIcon.vue';
import { useForm } from '@inertiajs/vue3';
import ProfileIcon from '@/Components/Icons/ProfileIcon.vue';
import JobIcon from '@/Components/Icons/JobIcon.vue';
import CoverLetterIcon from '@/Components/Icons/CoverLetterIcon.vue';
import ResumeIcon from '@/Components/Icons/ResumeIcon.vue';

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
        class="text-2xl font-bold transition-colors ease-in-out hover:text-orange-500"
        :class="{
          'text-white': !mobileMenuOpen,
          'text-black': mobileMenuOpen,
        }"
      >
        <a :href="route('dashboard')">
          Applicy
          <span class="text-orange-600">.</span>
        </a>
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

    <!-- Transition wrapper for the mobile menu -->
    <Transition
      name="fade-slide"
      enter-active-class="transition ease-in-out duration-300"
      leave-active-class="transition ease-in-out duration-300"
      enter-from-class="opacity-0 transform -translate-y-10"
      enter-to-class="opacity-100 transform translate-y-0"
      leave-from-class="opacity-100 transform translate-y-0"
      leave-to-class="opacity-0 transform -translate-y-10"
    >
      <div v-show="mobileMenuOpen" class="fixed inset-0 bg-white px-8 py-24">
        <ul class="flex flex-col gap-8">
          <li class="text-black font-normal hover:font-semibold space-y-6">
            <a
              :href="route('applications.index')"
              class="flex items-center gap-4"
            >
              <JobIcon />
              <span>Applications</span>
            </a>
          </li>
          <li class="text-black font-normal hover:font-semibold space-y-6">
            <a :href="route('resumes.index')" class="flex items-center gap-4">
              <ResumeIcon />
              <span>Resumes</span>
            </a>
          </li>
          <li class="text-black font-normal hover:font-semibold space-y-6">
            <a
              :href="route('cover-letter.index')"
              class="flex items-center gap-4"
            >
              <CoverLetterIcon />
              <span>Cover Letters</span>
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
    </Transition>
  </nav>
</template>

<style scoped>
/* Custom transition classes */
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition:
    opacity 0.3s ease-in-out,
    transform 0.3s ease-in-out;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
  opacity: 100;
  transform: translateY(0);
}
</style>
