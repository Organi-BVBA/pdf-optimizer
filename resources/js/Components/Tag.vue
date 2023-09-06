<template>
  <span
    class="py-1 px-3 rounded-full text-xs"
    :class="getClass()"
  >
    <!-- @slot Internal value of the tag -->
    <slot />
  </span>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent( {
  props: {
    /**
     * Color of the tag component
     * @values blue, yellow, green, red
     */
    color: {
      type: String,
      default: 'red',
      validator ( value ) {
        return [ 'purple', 'blue', 'yellow', 'green', 'red' ].includes( value );
      },
    },
  },

  methods: {
    getClass () {
      // This way the classes won't get treeshaken
      return {
        'bg-purple-200 dark:bg-purple-800': this.color === 'purple',
        'text-purple-800 dark:text-purple-300': this.color === 'purple',
        'bg-blue-200 dark:bg-blue-800': this.color === 'blue',
        'text-blue-800 dark:text-blue-300': this.color === 'blue',
        'bg-yellow-200 dark:bg-yellow-800': this.color === 'yellow',
        'text-yellow-800 dark:text-yellow-300': this.color === 'yellow',
        'bg-red-200 dark:bg-red-800': this.color === 'red',
        'text-red-800 dark:text-red-300': this.color === 'red',
        'bg-green-200 dark:bg-green-800': this.color === 'green',
        'text-green-800 dark:text-green-300': this.color === 'green',
      };
    },
  },
} );
</script>
