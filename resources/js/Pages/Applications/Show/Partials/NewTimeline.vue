<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref, watch } from 'vue';
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
  notes: '',
});

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
