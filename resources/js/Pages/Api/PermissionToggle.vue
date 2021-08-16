<template>
  <SwitchGroup
    as="div"
    class="flex items-center"
  >
    <Switch
      v-model="enabled"
      :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']"
    >
      <span class="sr-only">Select token permission</span>
      <span
        aria-hidden="true"
        :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']"
      />
    </Switch>
    <SwitchLabel
      as="span"
      class="ml-3"
    >
      <span class="text-sm capitalize font-medium text-gray-900">{{ permission }}</span>
    </SwitchLabel>
  </SwitchGroup>
</template>

<script>
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import {ref, watch} from 'vue'
export default {
    name: "PermissionToggle",
    components: {
        Switch,
        SwitchGroup,
        SwitchLabel,
    },
    props: {
        permission: {
            type: String,
            required: true
        },
        abilities: {
            type: Array,
            required: false,
            default: () => []
        }
    },
emits: ['update:abilities'],
    setup(props, {emit}) {
        const enabled = ref(_.includes(props.abilities, props.permission))

        watch(enabled,() => {

            if(enabled.value) {

                emit('update:abilities', _.uniq([...props.abilities, props.permission]))

            } else {

                // 1. remove scope props
                let newSelected = props.abilities.filter( (el) => !props.abilities.includes(el))

                emit('update:abilities', newSelected)
            }
        })

        return {
            enabled
        }
    }
}
</script>

<style scoped>

</style>