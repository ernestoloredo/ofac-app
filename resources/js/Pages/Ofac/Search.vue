<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3'

const props = defineProps({
  q: String, list: String, country: String, program: String, entries: Object
})
const q = ref(props.q ?? '')
const list = ref(props.list ?? 'sdn')
const country = ref(props.country ?? '')
const program = ref(props.program ?? '')

function search() {
  router.get(route('ofac.search'), {
    q: q.value, list: list.value, country: country.value, program: program.value
  }, { preserveState: true })
}
</script>

<template>
  <div class="p-6 max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">OFAC – Search</h1>

    <div class="grid md:grid-cols-4 gap-3 mb-4">
      <input v-model="q" @keyup.enter="search" class="border rounded px-3 py-2" placeholder="Name / Alias / ID number" />
      <select v-model="list" class="border rounded px-3 py-2">
        <option value="sdn">SDN</option>
        <option value="consolidated">Consolidated (non-SDN)</option>
      </select>
      <input v-model="country" @keyup.enter="search" class="border rounded px-3 py-2" placeholder="Country" />
      <input v-model="program" @keyup.enter="search" class="border rounded px-3 py-2" placeholder="Program code" />
    </div>

    <button @click="search" class="px-4 py-2 rounded bg-blue-600 text-white">Search</button>

    <div class="mt-6 space-y-3">
      <div v-for="e in entries.data" :key="e.id" class="p-4 rounded border">
        <div class="font-semibold">
          <Link :href="route('ofac.show', e.id)" class="underline">{{ e.name }}</Link>
          <span class="ml-2 text-xs px-2 py-1 rounded bg-gray-100">{{ e.entity_type }}</span>
        </div>
        <div class="text-sm mt-1">
          <strong>Programs:</strong>
          <span v-for="p in e.programs" :key="p.id" class="mr-2">{{ p.program_code }}</span>
        </div>
        <div class="text-sm">
          <strong>Countries:</strong>
          <span v-for="a in e.addresses" :key="a.id" class="mr-2">{{ a.country }}</span>
        </div>
      </div>
    </div>

    <div class="mt-6 flex gap-2">
      <template v-for="link in entries.links" :key="link.url">
        <Link v-if="link.url" :href="link.url" class="px-3 py-1 border rounded" :class="{'bg-blue-600 text-white': link.active}" v-html="link.label" />
        <span v-else class="px-3 py-1 border rounded opacity-50" v-html="link.label" />
      </template>
    </div>
  </div>
</template>
