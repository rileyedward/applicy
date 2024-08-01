<script setup>
defineProps({
  application: Object,
});
</script>

<template>
  <div class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Job URL:</label>
      <a
        :href="application.job_url"
        class="text-blue-500 underline"
        target="_blank"
        >Click Here</a
      >
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Contact Name:</label>
      <p>{{ application.contact_name }}</p>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Email:</label>
      <a
        :href="`mailto:${application.contact_email}`"
        class="text-blue-500 underline"
        >{{ application.contact_email }}</a
      >
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Phone Number:</label>
      <a
        :href="`tel:${application.contact_phone}`"
        class="text-blue-500 underline"
        >{{ application.contact_phone }}</a
      >
    </div>
  </div>
</template>
