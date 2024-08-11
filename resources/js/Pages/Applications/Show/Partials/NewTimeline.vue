<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref, watch, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import DownArrowIcon from '@/Components/Icons/DownArrowIcon.vue';

const props = defineProps({
  jobApplication: Object,
  statusSelections: Array,
});

defineEmits(['toggleDetailedView']);

const showModal = ref(false);

const form = useForm({
  new_status: props.jobApplication.status,
  title: '',
  interview_date: '',
  interview_time: '',
  interview_url: '',
  notes: '',
});

const isInterview = computed(() => form.new_status === 'interview_scheduled');

watch(
  () => form.new_status,
  () => {
    form.title = form.new_status.split('_').join(' ');
    form.title = form.title.charAt(0).toUpperCase() + form.title.slice(1);
  }
);

const submit = () => {
  form.post(route('applications.actions.store', props.jobApplication.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      showModal.value = false;
    },
  });
};
</script>

<template>
  <div>
    <div class="flex justify-between items-center">
      <button
        @click="showModal = true"
        class="flex items-center justify-center bg-orange-500 text-white w-10 h-10 rounded-full shadow-md hover:bg-orange-600 hover:scale-105"
        aria-label="Add"
      >
        <span class="text-2xl">+</span>
      </button>

      <button @click.prevent="$emit('toggleDetailedView')">
        <DownArrowIcon class="w-5 h-5" />
      </button>
    </div>

    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">New Action</h3>
        <p class="text-sm text-neutral-300 mb-6">
          Add a new action to your application timeline.
        </p>

        <form @submit.prevent="submit" class="space-y-6">
          <div class="w-full">
            <InputLabel for="status" value="Status" />
            <SelectInput
              v-model="form.new_status"
              :options="statusSelections"
              id="status"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
          </div>

          <div class="w-full">
            <InputLabel for="title" value="Title" />
            <TextInput
              v-model="form.title"
              id="title"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Enter a title for this action..."
            />
            <InputError :message="form.errors.title" class="mt-1" />
          </div>

          <hr v-if="isInterview" class="border-neutral-600 my-6" />

          <div v-if="isInterview" class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
              <InputLabel for="interview_date" value="Interview Date" />
              <TextInput
                v-model="form.interview_date"
                id="interview_date"
                type="date"
                class="mt-1 block w-full bg-neutral-700 border-none"
              />
              <InputError :message="form.errors.interview_date" class="mt-1" />
            </div>
            <div class="flex-1">
              <InputLabel for="interview_time" value="Interview Time" />
              <TextInput
                v-model="form.interview_time"
                id="interview_time"
                type="time"
                class="mt-1 block w-full bg-neutral-700 border-none"
              />
              <InputError :message="form.errors.interview_time" class="mt-1" />
            </div>
          </div>

          <div v-if="isInterview" class="w-full">
            <InputLabel for="interview_url" value="Interview URL" />
            <TextInput
              v-model="form.interview_url"
              id="interview_url"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Enter the URL for the interview..."
            />
            <InputError :message="form.errors.interview_url" class="mt-1" />
          </div>

          <hr v-if="isInterview" class="border-neutral-600 my-6" />

          <div class="w-full">
            <InputLabel for="notes" value="Notes" />
            <TextArea
              v-model="form.notes"
              id="notes"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Enter notes for this action..."
            />
            <InputError :message="form.errors.notes" class="mt-1" />
          </div>

          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-orange-500 text-white px-2 py-1 rounded-md shadow-md hover:bg-orange-600"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>
