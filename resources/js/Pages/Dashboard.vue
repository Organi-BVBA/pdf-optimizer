<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>


    <div class="w-4/5 mx-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
      <div class="flex items-center justify-around px-4 py-6 bg-white rounded-xl space-x-2 mt-10 shadow-lg">
        <div>
          <span class="text-sm font-semibold text-gray-400">
            Uploaded
          </span>

          <h1 class="text-2xl font-bold">
            {{ total }}
          </h1>
        </div>


        <font-awesome-icon
          class="text-indigo-600"
          icon="upload"
          size="2x"
        />
      </div>

      <div class="flex items-center justify-around px-4 py-6 bg-white rounded-xl space-x-2 mt-10 shadow-lg">
        <div>
          <span class="text-sm font-semibold text-gray-400">
            Saved
          </span>

          <h1 class="text-2xl font-bold">
            {{ saved }}
          </h1>
        </div>


        <font-awesome-icon
          class="text-indigo-600"
          icon="hdd"
          size="2x"
        />
      </div>

      <div class="flex items-center justify-around px-4 py-6 bg-white rounded-xl space-x-2 mt-10 shadow-lg">
        <div>
          <span class="text-sm font-semibold text-gray-400">
            % Saved
          </span>

          <h1 class="text-2xl font-bold">
            {{ percentage }}%
          </h1>
        </div>


        <font-awesome-icon
          class="text-indigo-600"
          icon="percent"
          size="2x"
        />
      </div>

      <div class="flex items-center justify-around px-4 py-6 bg-white rounded-xl space-x-2 mt-10 shadow-lg">
        <div>
          <span class="text-sm font-semibold text-gray-400">
            Total webhooks
          </span>

          <h1 class="text-2xl font-bold">
            {{ count }}
          </h1>
        </div>

        <font-awesome-icon
          class="text-indigo-600"
          icon="check"
          size="2x"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default defineComponent( {
  components: {
    AppLayout,
  },
  props: {
    total: {
      type: String,
      default: '',
    },
    optimized: {
      type: String,
      default: '',
    },
    saved: {
      type: String,
      default: '',
    },
    percentage: {
      type: Number,
      default: 0,
    },
    count: {
      type: Number,
      default: 0,
    },
  },
} );
</script>
