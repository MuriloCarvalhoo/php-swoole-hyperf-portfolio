<template>
  <div id="header">
    <nav class="navbar fixed-top bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" :href="baseUrl">
          <img :src="baseUrl+'/img/oak_logo.png'" alt="Logo" style="width: 100px;">
        </a>
        <div class="d-flex">
          <div class="search">
            <input class="input" type="text" placeholder="Titles, people, genres" id="search" v-model="searchInput" >            
            <svg id="serach-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg" class="search-icon ltr-4z3qvp e1svuwfo1" data-name="MagnifyingGlass"
              aria-hidden="true">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10ZM15.6177 17.0319C14.078 18.2635 12.125 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 12.125 18.2635 14.078 17.0319 15.6177L22.7071 21.2929L21.2929 22.7071L15.6177 17.0319Z"
                fill="currentColor"></path>
            </svg>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import Icon from "vue-awesome/components/Icon";

export default {
  name: "Header",
  data() {
    return {
      searchInput: "",
      baseUrl: process.env.MIX_BASE_URL,
    };
  },
  components: {
    "v-icon": Icon
  },
  methods: {
    navigateMain() {
      this.$router.push({ name: "Main" });
    },
    navigateMyList() {
      this.$router.push({ name: "MyList" });
    }
  },
  watch: {
    searchInput() {
      console.log(this.searchInput)
      if(this.searchInput){
        this.$emit("changeSearch", this.searchInput);
      }
    }
  }
};
</script>

<style>
  #header {
    width: 100%;
    height: 30%;
    background: #141414;
    display: flex;
    align-items: center;
  }
</style>
