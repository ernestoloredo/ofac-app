<script setup>
const props = defineProps({ entry: Object })
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-2">{{ entry.name }}</h1>
    <div class="text-sm text-gray-600 mb-4">
      Type: {{ entry.entity_type }} • List: {{ entry.list_type.toUpperCase() }} • Active: {{ entry.active ? 'Yes' : 'No' }}
    </div>

    <div class="space-y-4">
      <section>
        <h2 class="font-semibold">Aliases</h2>
        <ul class="list-disc ml-6">
          <li v-for="a in entry.akas" :key="a.id">{{ a.alias }} <span v-if="a.strength" class="text-xs text-gray-500">({{ a.strength }})</span></li>
        </ul>
      </section>

      <section>
        <h2 class="font-semibold">Addresses</h2>
        <ul class="list-disc ml-6">
          <li v-for="a in entry.addresses" :key="a.id">
            {{ a.address }} {{ a.city }} {{ a.state }} {{ a.postal }} – <strong>{{ a.country }}</strong>
          </li>
        </ul>
      </section>

      <section>
        <h2 class="font-semibold">IDs</h2>
        <ul class="list-disc ml-6">
          <li v-for="i in entry.ids" :key="i.id">
            {{ i.type }}: {{ i.number }} ({{ i.country }})
          </li>
        </ul>
      </section>

      <section>
        <h2 class="font-semibold">Programs</h2>
        <div class="flex flex-wrap gap-2">
          <span v-for="p in entry.programs" :key="p.id" class="px-2 py-1 text-xs rounded bg-gray-100">{{ p.program_code }}</span>
        </div>
      </section>

      <section v-if="entry.remarks">
        <h2 class="font-semibold">Remarks</h2>
        <p class="whitespace-pre-wrap">{{ entry.remarks }}</p>
      </section>
    </div>
  </div>
</template>
