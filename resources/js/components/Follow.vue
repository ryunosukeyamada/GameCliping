<template>
  <div>
    <button
      type="button"
      class="btn btn-sm shadow-none rounded-lg pt-2 pb-2 h-auto"
      :class="color"
      @click="clickFollow"
    >
      <i class="fas mr-1" :class="icon"></i>
      {{ text }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    initialIsFollowdBy: {
      type: Boolean,
      default: false,
    },
    loginCheck: {
      type: Boolean,
      default: false,
    },
    url: {
      type: String,
    },
  },
  data() {
    return {
      isFollowdBy: this.initialIsFollowdBy,
    };
  },
  computed: {
    color() {
      return this.isFollowdBy ? "btn-success animated fadeIn" : "btn-outline-primary";
    },
    icon() {
      return this.isFollowdBy ? "fa-user-times" : "fa-user-plus";
    },
    text() {
      return this.isFollowdBy ? "フォロー中" : "フォロー";
    },
  },
  methods: {
    clickFollow() {
      if (this.loginCheck === false) {
        alert("ログインが必要です");
        return;
      }
      if (this.isFollowdBy === true) {
        this.unfollow();
      }else {
        this.follow();
      }
    },

    async follow() {
      const response = await axios.put(this.url);
      this.isFollowdBy = true;
    },
    async unfollow() {
      const response = await axios.delete(this.url);
      this.isFollowdBy = false;
    },
  },
};
</script>