<script setup>
defineProps({
  upcomingReminders: Array,
});
</script>

<template>
  <aside class="bg-neutral-800 p-6 rounded-lg shadow-lg">
    <h4 class="text-xl font-bold text-neutral-100 mb-2">Reminders</h4>

    <p v-if="upcomingReminders.length > 0" class="text-neutral-400 mb-6">
      Here are your upcoming reminders.
    </p>

    <div v-if="upcomingReminders.length > 0" class="space-y-4">
      <a
        v-for="reminder in upcomingReminders"
        :key="reminder.id"
        :href="route('applications.show', reminder.id)"
        class="flex flex-col-reverse md:flex-row justify-between py-1 px-2 items-start md:items-center bg-neutral-800 hover:bg-neutral-900 rounded-lg cursor-pointer"
      >
        <div>
          <p class="text-lg font-semibold text-neutral-100">
            {{ reminder.position }}
          </p>
          <p class="text-neutral-400">
            {{ reminder.company_name }}
          </p>
        </div>

        <div class="text-right">
          <p class="text-sm text-neutral-500">
            {{ reminder.status_pretty }}
          </p>
        </div>
      </a>
    </div>

    <div v-else class="flex items-center">
      <p class="text-neutral-500">No reminders at this time!</p>
    </div>
  </aside>
</template>
