<template>
  <div id="newMovies">
    <div id="slide">
      <h1>{{ description }}</h1>
      <div v-show="showLoading" id="loadingMovie">
        <Spinner />
      </div>
      <carousel
        :per-page="6"
        :navigate-to="0"
        :mouse-drag="true"
        :paginationEnabled="false"
        :navigationEnabled="true"
        :navigationClickTargetSize="9"
        :loop="true"
      >
        <slide
          :key="movie.id + Math.random()"
          v-for="movie in movies"
        >
          <div @click="showDetail(movie.id)">
            <img :src="movie.img == null ? getUrlImg(movie.tconst) : movie.img" id="imagemPosterSlide" :class="`img-id-${movie.tconst}`" loading="lazy"/>
          </div>
        </slide>
      </carousel>
    </div>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
import Spinner from "./Spinner.vue";
import { Movies } from "../services/movie/request.js";

export default {
  name: "Movies",
  data() {
    return {
      movies: [],
      showLoading: true,
      paginationButtons: false
    };
  },
  props: {
    type: String,
    description: String,
  },
  components: {
    Carousel,
    Slide,
    Spinner
  },
  mounted() {
    this.getMovieDetail();
  },
  methods: {
    async getMovieDetail(){
      this.showLoading = true;
      try {
        const Search = await Movies(this.type).get();
        this.movies = Search?.data;

      } catch (error) {
        console.error(error);
      } finally {
        this.showLoading = false;
      }
    },
    getUrlImg(id) {
      try {
        axios.get(
          `${process.env.MIX_BASE_URL}/movies/url-img/${id}`
        ).then(res => {
          const img = document.querySelector(`.img-id-${id}`);
          img.src = res?.data;
          return false;
        });
      } catch (error) {
        console.error(error);
      }
    },
    showDetail(_id) {
      this.$router.push({ name: "Detail", params: { id: _id } });
    },
  }
};
</script>
<style>
#slide {
  width: 90%;
  height: 100%;
  text-align: center;
  margin: auto;
}
#newMovies {
  width: 100%;
  height: 100%;
  text-align: center;
  margin: auto;
}
#buttonNexts {
  color: #f1f;
}
#newMovies h1 {
  color: #cacaca;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 10px;
  margin-top: 15px;
  padding-left: 20px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
#loadingMovie {
  display: flex;
  justify-content: center;
  align-items: center;
}
.movieDiv {
  margin-top: 23px;
  padding-left: 20px;
  flex: 1;
}
#imagemPosterSlide {
  border-radius: 15px;
  transition: 0.5s;
  height: 300px;
  margin-bottom: 20px;
  width: 200px;
}
#imagemPosterSlide:hover {
  transform: scale(1.1);
  cursor: pointer;
}
.VueCarousel-navigation-button[data-v-453ad8cd] {
  color: #e9e9e9 !important;
  outline: none !important;
}

@media only screen and (max-width: 599px) {
  #imagemPosterSlide {
    height: 150px;
    width: 100px;
  }
  #newMovies h1 {
    font-size: 15px;
    margin-bottom: 5px;
    margin-top: 5px;
  }
}
</style>
