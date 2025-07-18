<template>
  <div>
    <input @change="preview" class="form-control form-control-square" type="file" ref="input_files" :accept="accept"
      :class="classNames" :name="name" />

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

    const currentRoute = this.$router && this.$route ? this.$route : null;
    // Dynamically get the first element after '/gallery/edit/' in the route path
    let modalName = null;
    if (currentRoute && currentRoute.path) {
      const segments = currentRoute.path.split('/').filter(Boolean);
      if (segments.length > 0) {
        modalName = this.getPlural(segments[0]);
        this.modalNames = segments;
        console.log("Plural Element:", modalName);
      }
    }

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
    getPlural: function(word) {
      if (!word || typeof word !== 'string') return word;
      
      const word_lower = word.toLowerCase();
      
      // Use Intl.PluralRules to determine if we need plural form
      const pluralRules = new Intl.PluralRules('en-US');
      const rule = pluralRules.select(2); // 2 means plural
      
      // Simple pluralization rules for English
      if (rule === 'other') {
        // Handle common irregular plurals
        const irregulars = {
          'child': 'children',
          'man': 'men', 
          'woman': 'women',
          'tooth': 'teeth',
          'foot': 'feet',
          'mouse': 'mice',
          'person': 'people'
        };
        
        if (irregulars[word_lower]) {
          return irregulars[word_lower];
        }
        
        // Words ending in 'y' preceded by consonant
        if (word_lower.endsWith('y') && !/[aeiou]/.test(word_lower[word_lower.length - 2])) {
          return word_lower.slice(0, -1) + 'ies';
        }
        
        // Words ending in 's', 'sh', 'ch', 'x', 'z'
        if (/[sxz]$|[cs]h$/.test(word_lower)) {
          return word_lower + 'es';
        }
        
        // Words ending in 'f' or 'fe'
        if (word_lower.endsWith('f')) {
          return word_lower.slice(0, -1) + 'ves';
        }
        if (word_lower.endsWith('fe')) {
          return word_lower.slice(0, -2) + 'ves';
        }
        
        // Default: add 's'
        return word_lower + 's';
      }
      
      return word_lower;
    },

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

    removeImage: async function (data) {
      if (this.item.slug) {
        const parsedData = { field: this.name, index: data.index };
        const confirmed = await window.s_confirm();
        if (!confirmed) return;
        const response = await axios.post(`${modalName}/image-delete/${this.item.slug}?data=${JSON.stringify(parsedData)}`);
        window.s_alert(response.data.message);
      }
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
