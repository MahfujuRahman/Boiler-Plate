<template>
  <div>
    <input
      @change="preview"
      class="form-control form-control-square"
      type="file"
      ref="input_files"
      :accept="accept"
      :class="classNames"
      :name="name"
    />

    <div v-if="image_preview && image_preview != ''" class="d-flex justify-content-start align-items-start">
      <a :href="image_preview" data-lightbox="image-preview" data-title="Preview">
        <img :src="image_preview" class="mt-2 image-preview-img" alt="image" target="_black" />
      </a>

      <button class="btn btn-warning btn-sm mt-2 p-1 image-remove-btn" @click.prevent="remove">X</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      required: true,
      default: "image",
    },
    multiple: {
      default: false,
    },
    classNames: {
      default: "form-control",
    },
    accept: {
      required: true,
    },
    value: {
      type: String,
      default: null,
    },
  },
  data: () => ({
    image_preview: null,
  }),

  created: function () {
    this.$watch(
      "value",
      (newValue) => {
        if (newValue) {
          this.image_preview = newValue;
        }
      },
      { immediate: true }
    );
  },

  methods: {
    preview: function () {
      const file = this.$refs.input_files.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (e) => {
        const base64String = e.target.result;
        this.image_preview = base64String;
      };
      reader.readAsDataURL(file);
    },

    remove: function () {
      this.image_preview = null;
      this.$refs.input_files.value = null;
    },
  },
};
</script>

<style scoped>
.image-preview-img {
  width: 200px;
  height: 80px;
  object-fit: cover;
  object-position: center center;
  border: 1px solid #ffffff2e;
  padding: 2px;
}
.image-remove-btn {
  margin-left: -18px;
  border-radius: 0px;
  position: static;
}
</style>
