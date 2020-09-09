<template>
  <div>
    <button type="button" class="btn m-0 p-0 shadow-none" @click="clickLike()">
      <i class="fas fa-heartbeat mr-1" :class="{'red-text':this.dataIsLikedBy, 'animated jackInTheBox fast':this.animationLike}"></i>
      {{ dataCountLikes }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    initialIsLikedBy: {
      type: Boolean,
      default: false,
    },
    initialCountLikes: {
      type: Number,
      default: 0,
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
      dataIsLikedBy: this.initialIsLikedBy,
      dataCountLikes: this.initialCountLikes,
      animationLike: false,
    };
  },

  methods: {
    clickLike() {
      if (this.loginCheck === false) {
        alert("ログインが必要です");
        return;
      }
      if (this.dataIsLikedBy === true) {
        this.unlike();
      } else {
        this.like();
      }
    },

    async like() {
      const response = await axios.put(this.url);
      this.dataIsLikedBy= true;
      this.animationLike = true;
      this.dataCountLikes = response.data.countLikes;
    },
    async unlike() {
      const response = await axios.delete(this.url);
      this.dataIsLikedBy= false;
      this.animationLike = false;
      this.dataCountLikes = response.data.countLikes;
    },
  },
};
</script>