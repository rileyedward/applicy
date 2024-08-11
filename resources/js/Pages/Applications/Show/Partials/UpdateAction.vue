<script setup>
import TextInput from '@/Components/Breeze/TextInput.vue';
import Modal from '@/Components/Breeze/Modal.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import SelectInput from '@/Components/Breeze/SelectInput.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import { computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';

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
  interview_date: '',
  interview_time: '',
  interview_url: '',
  notes: props.action?.notes ?? '',
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

const removeAction = () => {
  if (confirm('Are you sure you want to remove this action?')) {
    form.delete(
      route('applications.actions.destroy', [
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
  }
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

        <div class="flex justify-end gap-4">
          <SecondaryButton @click.prevent="removeAction">
            Remove
          </SecondaryButton>
          <PrimaryButton
            type="submit"
            :disabled="form.processing"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
