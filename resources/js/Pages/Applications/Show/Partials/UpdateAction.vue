<script setup>
import TextInput from '@/Components/Breeze/TextInput.vue';
import Modal from '@/Components/Breeze/Modal.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import { watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  show: Boolean,
  action: Object,
  jobApplication: Object,
  statusSelections: Array,
});

const emits = defineEmits(['close']);

const form = useForm({
  new_status: props.action?.new_status ?? props.statusSelections[0].value,
  title: props.action?.title ?? '',
  notes: props.action?.notes ?? '',
});

watch(
  () => form.new_status,
  () => {
    form.title = form.new_status.split('_').join(' ');
    form.title = form.title.charAt(0).toUpperCase() + form.title.slice(1);
  }
);

const submit = () => {
  form.put(
    route('applications.actions.update', [
      props.jobApplication.id,
      props.action.id,
    ]),
    {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        emits('close');
      },
    }
  );
};
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6">
      <h3 class="text-lg font-medium text-neutral-100 mb-1">Update Action</h3>
      <p class="text-sm text-neutral-300 mb-6">
        Update the action for this application.
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
</template>
