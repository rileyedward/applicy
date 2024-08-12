<script setup>
defineProps(['fileUploaded']);
</script>

<template>
  <div class="flex flex-col items-center justify-center pt-5 pb-6">
    <svg
      aria-hidden="true"
      class="w-10 h-10 mb-3 text-neutral-500"
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M7 16V10m0 0l5-5m-5 5l5 5M12 10h7m-7 4h7"
      ></path>
    </svg>
    <p v-if="fileUploaded" class="text-sm text-center text-neutral-400">
      File uploaded
    </p>
    <div v-else class="text-center">
      <p class="mb-2 text-sm text-neutral-400">
        <span class="font-semibold">Click to upload</span> or drag and drop
      </p>
      <p class="text-xs text-neutral-500">PDF files only (max 2MB)</p>
    </div>
  </div>
</template>
