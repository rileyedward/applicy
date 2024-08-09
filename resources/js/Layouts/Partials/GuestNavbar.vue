<template>
  <nav>
    <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-6">
      <h1 class="text-2xl font-bold">
        <a :href="route('index')"> Applicy. </a>
      </h1>

      <a
        class="bg-orange-700 text-white text-sm px-6 py-1 rounded-md font-semibold hover:bg-orange-500"
        :href="route('dashboard')"
      >
        Dashboard
      </a>
    </div>
  </nav>
</template>
