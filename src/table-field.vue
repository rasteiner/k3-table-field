<template>
  <k-field 
    :label="label"
  >
    <table>
      <thead>
        <tr>
          <th v-for="(label, key) in columns" :key="key">{{label}}</th>
          <td class="options"></td>
        </tr>
      </thead>
      <tr v-for="(row, index) of rows" :key="index">
        <td v-for="(label, key) in columns" :key="key">
          <input type="text" :ref="`row_${index}_col_${key}`" :value="row[key]" @input="update(index, key, $event.target.value)">
        </td>
        <td class="options">
          <k-button @click="remove(index)" >
            <k-icon type="cancel" />
          </k-button>
        </td>
      </tr>
      <tr>
        <td v-for="(label, key) in columns" :key="key">
          <input type="text" @input="handleNewValue(key, $event.target)" >
        </td>
        <td class="options">
          
        </td>
      </tr>
    </table>
  </k-field>
</template>

<script>
export default {
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
    update(rowindex, key, value) {
      this.rows[rowindex][key] = value
      this.$emit('input', this.rows)
    },
    remove(index) {
      this.rows.splice(index,1)
      this.$emit('input', this.rows)
    },
    handleNewValue(key, target) {
      const value = target.value
      const obj = {}
      
      obj[key] = value
      const ss = target.selectionStart
      const se = target.selectionEnd

      target.value = ''
      this.rows.push(obj)
      this.$nextTick(()=> {
        const ref = this.$refs[`row_${this.rows.length - 1}_col_${key}`][0]
        ref.focus()
        ref.selectionStart = ss
        ref.selectionEnd = se
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
input[type=text] {
  width: 100%;
  display: block;
  height: 1.5rem;
}
th {
  text-align: left;
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
