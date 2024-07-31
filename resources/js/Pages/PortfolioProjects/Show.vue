<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  portfolioProject: Object,
});

const form = useForm({
  project_name: props.portfolioProject.project_name,
  description: props.portfolioProject.description,
  skills: props.portfolioProject.skills,
});

const removeProject = () => {
  if (confirm('Are you sure you want to delete this project?')) {
    useForm({}).delete(
      route('portfolio-project.destroy', props.portfolioProject.id)
    );
  }
};
</script>

<template>
  <Head title="Projects - Settings" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Projects
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form
            @submit.prevent="
              form.put(
                route('portfolio-project.update', props.portfolioProject.id)
              )
            "
          >
            <div>
              <InputLabel for="project_name" value="Project Name" />

              <TextInput
                id="project_name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.project_name"
                required
                autofocus
                autocomplete="project_name"
              />

              <InputError class="mt-2" :message="form.errors.project_name" />
            </div>

            <div class="mt-4">
              <InputLabel for="description" value="Description" />

              <TextArea
                id="description"
                type="text"
                class="mt-1 block w-full"
                v-model="form.description"
                required
                autofocus
                autocomplete="description"
              />

              <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="mt-4">
              <InputLabel for="skills" value="Skills" />

              <TextArea
                id="skills"
                type="text"
                class="mt-1 block w-full"
                v-model="form.skills"
                required
                autofocus
                autocomplete="skills"
              />

              <InputError class="mt-2" :message="form.errors.skills" />
            </div>

            <div class="flex items-center justify-end gap-4 mt-4">
              <SecondaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.prevent="removeProject"
              >
                Remove
              </SecondaryButton>
              <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Save
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
