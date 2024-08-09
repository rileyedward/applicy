<script setup>
import JobHuntSketch from '@/Components/Sketches/JobHuntSketch.vue';
</script>

<template>
  <section
    class="max-w-6xl h-[100vh] md:h-[65vh] mx-auto px-8 flex justify-center mt-32 md:mt-48 gap-24"
  >
    <div class="w-full mt-8 md:mt-16">
      <h1 class="text-4xl font-bold mb-4">
        Streamline your job <br />
        hunt journey.
      </h1>
      <p class="mb-4">
        Create a personalized profile to seamlessly track all your job
        applications and monitor their progress in real time.
      </p>
      <a
        :href="route('register.index')"
        class="bg-orange-600 text-white px-4 py-1 rounded-md font-semibold hover:bg-orange-700 transition-all"
      >
        Get Started
      </a>
    </div>

    <div class="hidden md:block w-full">
      <JobHuntSketch />
    </div>
  </section>
</template>
