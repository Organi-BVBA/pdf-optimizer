<template>
  <app-layout title="Webhooks">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Webhooks
      </h2>
    </template>

    <div class="pt-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-4">
          <jet-label
            for="search"
            value="Search"
          >
            <!-- -->
          </jet-label>
          <jet-input
            id="search"
            v-model="search"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
            @update:modelValue="searchWebhooks"
          >
            <!-- -->
          </jet-input>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <table class="min-w-max w-full table-auto">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">
                  ID
                </th>

                <th class="py-3 px-6 text-center">
                  Date
                </th>

                <th class="py-3 px-6 text-center">
                  Status
                </th>

                <th class="py-3 px-6 text-center">
                  Delivery
                </th>
              </tr>
            </thead>

            <tbody class="text-gray-600 text-sm font-light">
              <tr
                v-for="webhook in filteredWebhooks.data"
                :key="webhook.uuid"
                class="border-b border-gray-200 hover:bg-gray-100"
                @click="navigateTo(webhook.uuid)"
              >
                <td class="py-3 px-6 text-left whitespace-nowrap">
                  {{ webhook.uuid }}
                </td>

                <td class="py-3 px-6 text-center">
                  {{ formatDateTime(webhook.created_at) }}
                </td>

                <td
                  class="py-3 px-6 text-center"
                >
                  <tag
                    :color="webhook.status_color"
                  >
                    {{ webhook.status_description }}
                  </tag>
                </td>

                <td class="py-3 px-6 text-center">
                  <tag
                    v-if="webhook.response"
                    :color="webhook.response_color"
                  >
                    {{ webhook.response }}
                  </tag>
                </td>
              </tr>
            </tbody>
          </table>

          <pagination
            class="m-2"
            :links="filteredWebhooks.links"
            :meta="filteredWebhooks"
          />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Tag from '@/Shared/Tag.vue';
import Pagination from '@/Shared/Pagination.vue';
import JetInput from '@/Jetstream/Input.vue';
import axios from 'axios';

export default defineComponent( {
  components: {
    AppLayout,
    Pagination,
    Tag,
    JetInput,
  },
  props: {
    webhooks: {
      type: Object,
      default: () => {},
    },

    q: {
      type: String,
      default: null,
    },
  },
  data () {
    return {
      dateConfig: { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' },
      timeConfig: { hour: '2-digit', minute: '2-digit' },

      search: null,
      filteredWebhooks: [],
    };
  },

  mounted () {
    this.search = this.q;
    this.filteredWebhooks = this.webhooks;
  },

  methods: {
    formatDateTime ( x ) {
      let d = new Date( x );

      return d.toLocaleDateString( undefined, this.dateConfig ) + ' ' + d.toLocaleTimeString( [], this.timeConfig );
    },

    navigateTo ( uuid ) {
      window.location.href = route( 'webhook', [ uuid ] );
    },

    searchWebhooks () {
      axios.get( '/search', { params: { q: this.search } } )
        .then( ( res ) => {
          this.filteredWebhooks = res.data.webhooks;
        } )
        .catch( error => {} );
    },

  },
} );
</script>
