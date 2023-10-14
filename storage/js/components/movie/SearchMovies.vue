<template>
  <div class="container text-center mt-5">
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3" >
      <div 
        v-for="(record, index) in records" :key="index" 
        
        class="col">
        <figure class="figure">
          <img :src="record.img == null ? 'https://m.media-amazon.com/images/G/01/imdb/images/social/imdb_logo.png' : record.img" class="figure-img img-fluid rounded" :class="`img-id-${record.tconst}`" alt="..." style="width:245px ; height:165px;">
          <figcaption class="figure-caption text-center text-white">{{ record?.original }}</figcaption>
        </figure>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "SearchMovies",
  props: {
    search: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      page: "movies/get-elastic?",
      baseUrl: process.env.MIX_BASE_URL,
      records: [],
    };
  },
  methods: {
    get() {

      let url = `${this.baseUrl}/${this.page}`
      url = this.search ? url.concat(`&search=${this.search}`) : url

      if (this.search) {
        axios.get(url).then(async res => {
          this.records = res.data;

          for (const record of this.records) {
            if (record?.img == null) {
              await axios.get(`${process.env.MIX_BASE_URL}/movies/url-img/${record?.tconst}`).then(res => {
                const img = document.querySelector(`.img-id-${record?.tconst}`);
                img.src = res?.data;
                return;
              });
            }
          }
        });
      }
      return;
    },
  },
  watch: {
    search() {
      this.get();
    },
  }
};
</script>

<style></style>
