<template>
  <app-layout title="Webhook">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Webhook {{ webhook.uuid }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-w-max w-full table-auto mb-4">
          <tbody class="text-gray-600 text-sm font-light">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Status
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                <tag
                  :color="webhook.status_color"
                >
                  {{ webhook.status_description }}
                </tag>
              </td>
              <th
                class="py-3 px-6 text-center"
              >
                Response
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                <tag
                  v-if="webhook.response"
                  :color="webhook.response_color"
                >
                  {{ webhook.response }}
                </tag>
                <tag
                  v-else-if="webhook.wait"
                  color="green"
                >
                  Caller waited for response
                </tag>
                <tag
                  v-else
                  color="red"
                >
                  No Response
                </tag>
              </td>
              <th
                class="py-3 px-6 text-center"
              >
                Extension
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                <tag
                  color="purple"
                >
                  {{ webhook.ext }}
                </tag>
              </td>
            </tr>

            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Url
              </th>
              <td
                colspan="5"
                class="py-3 px-6 text-center"
              >
                <a
                  :href="webhook.url"
                  target="_blank"
                >
                  {{ webhook.url }}
                </a>
              </td>
            </tr>

            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Webhook
              </th>
              <td
                colspan="5"
                class="py-3 px-6 text-center"
              >
                <a
                  :href="webhook.webhook"
                  target="_blank"
                >
                  {{ webhook.webhook }}
                </a>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-w-max w-full table-auto mt-4">
          <tbody class="text-gray-600 text-sm font-light">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Original Size
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.original_size_readable }}
              </td>
              <th
                class="py-3 px-6 text-center"
              >
                Optimized Size
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.optimized_size_readable }}
              </td>
              <th
                class="py-3 px-6 text-center"
              >
                Saved Space
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.saved_readable }} ({{ webhook.saved_percentage }}%)
              </td>
            </tr>

            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Fit/Crop type
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.fit_crop_type || 'None' }}
              </td>

              <th
                class="py-3 px-6 text-center"
              >
                Width
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.width }}
              </td>
              <th
                class="py-3 px-6 text-center"
              >
                Height
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.height }}
              </td>
            </tr>

            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <th
                class="py-3 px-6 text-center"
              >
                Wait
              </th>
              <td
                class="py-3 px-6 text-center"
              >
                {{ webhook.wait ? 'Yes' : 'No' }}
              </td>

              <th
                class="py-3 px-6 text-center"
              >
                Actions
              </th>
              <td
                class="py-3 px-6 text-center"
                colspan="3"
              >
                <tag
                  v-if="webhook.optimize"
                  color="blue"
                >
                  Optimize
                </tag>
                <tag
                  v-if="webhook.greyscale"
                  color="blue"
                >
                  Greyscale
                </tag>
                <tag
                  v-if="webhook.sepia"
                  color="blue"
                >
                  Sepia
                </tag>
                <tag
                  v-if="webhook.gamma > 0"
                  color="blue"
                >
                  Gamma: {{ webhook.gamma }}
                </tag>
                <tag
                  v-if="webhook.blur > 0"
                  color="blue"
                >
                  Blur: {{ webhook.blur }}
                </tag>
                <tag
                  v-if="webhook.pixelate > 0"
                  color="blue"
                >
                  Pixelate: {{ webhook.pixelate }}
                </tag>
                <tag
                  v-if="webhook.sharpen > 0"
                  color="blue"
                >
                  Sharpen: {{ webhook.sharpen }}
                </tag>
                <tag
                  v-if="webhook.brightness > 0"
                  color="blue"
                >
                  Brightness: {{ webhook.brightness }}
                </tag>
                <tag
                  v-if="webhook.contrast > 0"
                  color="blue"
                >
                  Contrast: {{ webhook.contrast }}
                </tag>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Tag from '@/Shared/Tag.vue';

export default defineComponent( {
  components: {
    AppLayout,
    Tag,
  },
  props: {
    webhook: {
      type: Object,
      default: () => {},
    },
  },
  data () {
    return {
      dateConfig: { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' },
      timeConfig: { hour: '2-digit', minute: '2-digit' },
    };
  },
  methods: {
    formatDateTime ( x ) {
      let d = new Date( x );

      return d.toLocaleDateString( undefined, this.dateConfig ) + ' ' + d.toLocaleTimeString( [], this.timeConfig );
    },

  },
} );
</script>
