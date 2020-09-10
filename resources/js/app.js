import './bootstrap'
import Vue from 'vue'
import Follow from './components/Follow'
import ClipLike from './components/ClipLike'
import ClipTagsInput from './components/ClipTagsInput'

const app= new Vue({
  el: '#app',
  components: {
    ClipLike,
    ClipTagsInput,
    Follow,
  }
});
