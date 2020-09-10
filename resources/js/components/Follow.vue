<template>
  <div>
    <button type="button" class="btn btn-sm shadow-none rounded-lg p-2"
    :class="color">
      <i class="fas mr-1"
      :class="icon"></i>
      {{ text }}
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isFollowdBy: false,
    }
  },
  computed: {
    color() {
      return this.isFollowdBy ? 'btn-outline-success':'btn-outline-primary'
    },
    icon() {
      return this.isFollowdBy ? 'fa-user-times': 'fa-user-plus'
    },
    text() {
      return this.isFollowdBy ? 'フォロー中': 'フォロー'
    }
  },
}
</script>