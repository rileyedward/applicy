<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import { watch } from 'vue';
import TextArea from '@/Components/Breeze/TextArea.vue';

const props = defineProps({
  show: Boolean,
  interview: Object,
});

const emits = defineEmits(['close']);

const form = useForm({
  interview_date: props.interview?.interview_date ?? '',
  interview_time: props.interview?.interview_time ?? '',
  notes: props.interview?.notes ?? '',
});

watch(
  () => props.interview,
  (value) => {
    form.interview_date = value?.interview_date ?? '';
    form.interview_time = value?.interview_time ?? '';
    form.notes = value?.notes ?? '';
  }
);

const submit = () => {
  form.put(route('resumes.index', props.interview.id), {
    preserveScroll: true,
    onSuccess: () => {
      emits('close');
    },
  });
};

const removeInterview = () => {
  if (confirm('Are you sure you want to delete this interview?')) {
    form.delete(route('resumes.index', props.interview.id), {
      preserveScroll: true,
      onSuccess: () => {
        emits('close');
      },
    });
  }
};

const markAsComplete = () => {
  if (confirm('Are you sure you want to mark this interview as complete?')) {
    form.put(route('resumes.index', props.interview.id), {
      preserveScroll: true,
      data: {
        completed: true,
      },
      onSuccess: () => {
        emits('close');
      },
    });
  }
};
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6 bg-neutral-800 rounded-lg">
      <h4 class="text-xl font-semibold text-neutral-100 mb-2">
        Interview for {{ interview.job_application.position }}
        <span class="text-orange-500 font-bold">@</span>
        {{ interview.job_application.company_name }}
      </h4>
      <p class="text-sm text-neutral-400 mb-6">
        Manage your interview settings here.
      </p>

      <!-- Mark as complete option -->
      <div class="flex mb-6">
        <SecondaryButton
          @click="markAsComplete"
          class="bg-orange-400 hover:bg-orange-500"
        >
          Mark as Complete
        </SecondaryButton>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        <div class="flex flex-col lg:flex-row gap-4">
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

        <div class="w-full">
          <InputLabel for="notes" value="Notes" />
          <TextArea
            v-model="form.notes"
            id="notes"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
        </div>

        <div class="flex justify-end gap-4">
          <SecondaryButton type="button" @click.prevent="removeInterview">
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
