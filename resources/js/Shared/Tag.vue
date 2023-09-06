<template>
  <span
    class="py-1 px-3 rounded-full text-xs"
    :class="getClass()"
  >
    <slot />
  </span>
</template>

<script>

export default {
  props: {
    color: {
      type: String,
      default: 'red',
      validator ( value ) {
        return [ 'purple', 'blue', 'yellow', 'green', 'red' ].includes( value );
      },
    },
  },
  methods: {
    getClass: function () {
      // This way the classes won't get treeshaked
      return {
        'bg-purple-200': this.color === 'purple',
        'text-purple-600': this.color === 'purple',
        'bg-blue-200': this.color === 'blue',
        'text-blue-600': this.color === 'blue',
        'bg-yellow-200': this.color === 'yellow',
        'text-yellow-600': this.color === 'yellow',
        'bg-red-200': this.color === 'red',
        'text-red-600': this.color === 'red',
        'bg-green-200': this.color === 'green',
        'text-green-600': this.color === 'green',
      };
    },
  },
};
</script>
