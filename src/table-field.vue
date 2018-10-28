<template>
  <k-field 
    :label="label"
  >
    <table>
      <thead>
        <tr>
          <th v-for="(label, key) in columns" :key="key">{{label.label || label}}</th>
          <td class="options"></td>
        </tr>
      </thead>
      <tr v-for="(row, index) of rows" :key="index">
        <td v-for="(definition, key) in columns" :key="key">
          <component 
            :is="getType(definition)"
            :ref="`row_${index}_col_${key}`"
            :definition="definition"
            :value="row[key]"
            @input="update(index, key, $event.value)"
          />
        </td>
        <td class="options">
          <k-button @click="remove(index)" >
            <k-icon type="cancel" />
          </k-button>
        </td>
      </tr>
      <tr>

        <td v-for="(definition, key) in columns" :key="key">
          <component 
            :is="getType(definition)"
            :ref="`row_${index}_col_${key}`"
            :definition="definition"
            :isBait="true"
            @input="handleNewValue(key, $event)"
          />
        </td>
        <td class="options"></td>
      </tr>
    </table>
  </k-field>
</template>

<script>

import textfield from './components/text.vue'
import selectfield from './components/select.vue'
import checkfield from './components/check.vue'

export default {
  components: {
    "rs-textfield": textfield,
    "rs-selectfield": selectfield,
    "rs-checkfield": checkfield,
  },
  data: function() {
    return {
      rows: this.value == null ? [] : this.value,
    }
  },
  props: {
    label: String,
    columns: Object,
    value: Array
  },
  watch: {
    value(v) {
      this.rows = v
    }
  },

  methods: {
    getType(obj) {
      const to = typeof obj
      if(to === 'object') {
        if(obj.type == 'select' && obj.options) {
          return 'rs-selectfield'
        }
        if(obj.type == 'checkbox') {
          return 'rs-checkfield'
        }
      }
      return 'rs-textfield'
    },
    update(rowindex, key, value) {
      this.rows[rowindex][key] = value
      this.$emit('input', this.rows)
    },
    remove(index) {
      this.rows.splice(index,1)
      this.$emit('input', this.rows)
    },
    handleNewValue(key, event) {
      const state = event.target.getState()
      const obj = {}
      
      obj[key] = event.value
      event.target.value = ''

      this.rows.push(obj)
      this.$nextTick(()=> {
        const ref = this.$refs[`row_${this.rows.length - 1}_col_${key}`][0]
        ref.activateState(state)
      })
      this.$emit('input', this.rows)
    }
  }
}
</script>

<style scoped>
table {
  width: 100%;
}
input[type=text], select {
  width: 100%;
  display: block;
  height: 1.5rem;
  min-width: 4rem;
}
th {
  text-align: left;
}
td {
  text-align: center;
}
td > * {
  vertical-align: middle;
  margin-right: 0.1rem;
}
td .k-button {
  padding: 0.2rem;
}
.options {
  width: 25px;
}

</style>
