<template>
  <div>
    <input type="hidden" name="tags" :value="tagsJson">
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      :autocomplete-items="filteredItems"
      @tags-changed="newTags => tags = newTags"
      placeholder="3個まで入力できます"
    />
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  components: {
    VueTagsInput,
  },
  data() {
    return {
      tag: '',
      tags: [],
      autocompleteItems: [{
        text: 'FPS'
      },{
        text: 'APEX',
      },{
        text: 'VALORANT'
      },{
        text: 'Fall Guys'
      },{
        text: 'Spellbreak'
      },{
        text: 'Hyper Scape'
      }, {
        text: 'COD'
      },{
        text: 'LOL'
      },{
        text: 'PUBG'
      }, {
        text: 'Overwatch'
      }, {
        text: 'CSGO'
      }, {
        text: '虹6'
      }],
    };
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
    tagsJson() {
      return JSON.stringify(this.tags)
    }
  },
};
</script>
<style lang="css" scoped>
  .vue-tags-input {
    max-width: inherit;
  }
</style>
