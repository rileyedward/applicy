<script setup>
const props = defineProps({
  activity: Object,
});

const gotoApplication = () => {
  window.location.href = route(
    'applications.show',
    props.activity.job_application.id
  );
};
</script>

<template>
  <div
    class="bg-neutral-800 p-4 rounded-lg hover:scale-105 cursor-pointer transition-transform"
    @click.prevent="gotoApplication"
  >
    <div class="flex flex-col-reverse md:flex-row items-center justify-between">
      <div class="text-center md:text-left">
        <h4 class="text-neutral-100 font-semibold text-base">
          {{ activity.title }}
        </h4>
        <p class="text-neutral-400 text-sm">
          {{ activity.job_application.position }}
        </p>
        <p class="text-neutral-400 text-sm">
          <span class="text-orange-500 font-semibold"> @ </span>
          {{ activity.job_application.company_name }}
        </p>
      </div>

      <div
        class="text-right flex flex-row md:flex-col items-center gap-4 md:gap-0"
      >
        <p class="text-neutral-300 text-sm">
          {{ activity.last_update }}
        </p>
      </div>
    </div>
  </div>
</template>
