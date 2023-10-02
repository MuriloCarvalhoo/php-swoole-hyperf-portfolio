export default {
  data() {
    return {
      registros: [],
      sort: 'id',
      asc: false,
      currentPage: null,
      totalPages: null,
      total: null,
    }
  },
  computed: {
    url() {
      let url = `${process.env.MIX_BASE_URL}/${this.page}/get?`
      url = this.tconst ? url.concat(`&tconst=${this.tconst}`) : url
      url = this.primary ? url.concat(`&primary=${this.primary}`) : url
      url = this.original ? url.concat(`&original=${this.original}`) : url
      url = this.isAdult ? url.concat(`&isAdult=${this.isAdult}`) : url
      url = this.startYear ? url.concat(`&startYear=${this.startYear}`) : url
      url = this.endYear ? url.concat(`&endYear=${this.endYear}`) : url
      url = this.runtimeMinutes ? url.concat(`&runtimeMinutes=${this.runtimeMinutes}`) : url
      url = this.genres ? url.concat(`&genres=${this.genres}`) : url
      return url
    },
    rows() {
      return this.totalPages
    }
  },
  methods: {
    async get() {
      this.loading = true

      await axios.get(this.url).then(res => {
        this.$refs['scroll'].scrollTop = 0
        this.registros = res.data.data
        this.currentPage = res.data.current_page
        this.totalPages = res.data.last_page
        this.total = res.data.total
        this.loading = false
      })
    },
    nextPage(url) {
      this.loading = true

      axios.get(url).then(res => {
        this.registros = res.data.data
        this.currentPage = res.data.current_page
        this.loading = false
      })
    },
    clickPagination(event) {
      let url = this.url.concat(`&page=${event}`)
      this.nextPage(url)
    },
    handleSort(field) {
      if (field == this.sort && this.asc == false) {
        this.sort = 'id'
      } else {
        this.sort = field
        this.asc = !this.asc
      }
      this.get()
    }
  },
  async created() {
    this.get()
  },

}
