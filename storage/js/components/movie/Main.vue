<template>
  <div id="app">
    <Header @changeSearch="changeSearch($event)" />
    <div v-if="!search">
      <NextReleases />
      <Movies :key="movie.id" :type="movie.type" :description="movie.description"  v-for="movie in movies"/>
      <h4>Movies</h4>
    </div>

    <div v-if="search">
      <SearchMovies :search="search" />
    </div>

  </div>
</template>

<script>
import Header from "./Header.vue";
import NextReleases from "./NextReleases.vue";
import Movies from "./Movies.vue";
import SearchMovies from "./SearchMovies.vue";

export default {
  name: "App",
  components: {
    Header,
    NextReleases,
    Movies,
    SearchMovies
  },
  data() {
    return {
      search: "",
    };
  },
  methods: {
    changeSearch(search) {
      this.search = search;
    },
  },
  computed: {
    movies() {
      return [
        {id: 1, type: "type_id=4", description: "Comedy"},
        {id: 2, type: "type_id=9", description: "Fantasy"},
        {id: 3, type: "type_id=10", description: "Horror"},
        {id: 4, type: "type_id=7", description: "News"},
        {id: 5, type: "type_id=5", description: "Romance"},
        {id: 6, type: "type_id=14", description: "Crime"},
        {id: 7, type: "type_id=2", description: "Short"}
      ]
    }
  }
};
</script>

<style>
#app h4 {
  color: #e9e9e9;
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  padding-top: 30px;
  padding-bottom: 30px;
}
@media only screen and (max-width: 599px) {
  #app h4 {
    font-size: 14px;
  }
}
</style>
