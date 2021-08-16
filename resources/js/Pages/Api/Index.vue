<template>
  <div class="space-y-3">
    <teleport to="#head">
      <title>{{ title(pageTitle) }}</title>
    </teleport>

    <PageHeader>
      {{ pageTitle }}
    </PageHeader>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
      <ul class="divide-y divide-gray-200">
        <li
          v-for="(token, tokenIdx) in tokens"
          :key="tokenIdx"
          class="px-4 py-4 sm:px-6"
        >
          <!-- Your content -->
          <div class="flex justify-between">
            <div class="flex flex-col">
              <span class="text-gray-900 block text-sm font-medium">
                {{ token.name }}
              </span>
              <span class="text-gray-500 block text-sm">
                ***************
              </span>
            </div>
            <div>
              <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                <button
                  type="button"
                  class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm"
                  @click="remove(token.id)"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </li>
        <li class="px-4 py-4 sm:px-6 space-y-3">
          <!-- Your content -->
          <div class="flex justify-between">
            <div
              v-if="plainTextToken"
              class="flex flex-col"
            >
              <span class="text-gray-900 block text-sm font-medium">
                {{ form.token_name }}
              </span>
              <span class="text-gray-500 block text-sm">
                {{ plainTextToken }}
              </span>
            </div>
            <div
              v-else
              class="w-2/4"
            >
              <label
                for="token"
                class="block text-sm font-medium text-gray-700"
              >
                Token Name
              </label>
              <div class="mt-1">
                <input
                  id="token"
                  v-model="form.token_name"
                  name="token"
                  type="text"
                  required="required"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
              </div>
            </div>
            <div v-if="!plainTextToken">
              <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                  @click="submit"
                >
                  Create token
                </button>
              </div>
            </div>
          </div>
          <div v-if="!plainTextToken">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Permissions
            </h3>
            <p class="mt-1 text-sm text-gray-500">
              Select all permissions which should be carried by the token.
            </p>
          </div>
          <div class="grid sm:grid-cols-2 gap-4">
            <PermissionToggle
              v-for="permission in permissions"
              :key="permission"
              v-model:abilities="form.abilities"
              :permission="permission"
            />
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import PageHeader from "@/Shared/Layout/PageHeader";
import {ref} from "vue";
import route from 'ziggy';
import { Inertia } from '@inertiajs/inertia'
import PermissionToggle from "./PermissionToggle";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    name: "Index",
    components: {
        PermissionToggle, PageHeader
    },
    props: {
        'tokens': {
            type: Array,
            required: true
        },
        'permissions': {
            type: Array,
            required: true
        },
        'plainTextToken': {
            type: String,
            required: false,
            default: ''
        }
    },
    data() {
        const token_name = ref('')
        const abilities = ref([])

        const form = useForm({
            token_name: '',
            abilities: [],
        })

        const submit = () => {
            form.value.post(route('create.api.token'))

           /* axios.post(route('create.api.token'), {
                token_name: token_name.value,
                abilities: abilities.value
            })
                .then(res => plainTextToken.value = res.data.token)
            .catch(error => console.log(error))*/
        }

        const remove = (tokenId) => axios
            .delete(route('delete.api.token', tokenId))
            .then(() => Inertia.reload())

        return {
            pageTitle: 'Api Keys',
            items: [],
            abilities,
            token_name,
            submit,
            remove,
            form
        }
    }
}
</script>

<style scoped>

</style>