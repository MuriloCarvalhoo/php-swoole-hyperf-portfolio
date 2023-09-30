<template>
	<b-modal id="formModal" no-close-on-backdrop>

		<template #modal-header="{ close }">
			<h5 v-if="post.id">Update Movie</h5>
			<h5 v-else>Create Movie</h5>
			<b-button size="sm" variant="outline-danger" @click="close()">X</b-button>
		</template>

		<template>
			<b-form-group label="Tconst" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`tconst`) }]" name="tconst"
					size="sm" v-model="post.tconst" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="tconst" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`tconst`)" class="invalid-feedback">
					{{ errors.first(`tconst`) }}
				</span>
			</b-form-group>

			<b-form-group label="Primary" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`primary`) }]" name="primary"
					size="sm" v-model="post.primary" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="primary" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`primary`)" class="invalid-feedback">
					{{ errors.first(`primary`) }}
				</span>
			</b-form-group>

			<b-form-group label="Original" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`original`) }]" name="original"
					size="sm" v-model="post.original" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="original" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`original`)" class="invalid-feedback">
					{{ errors.first(`original`) }}
				</span>
			</b-form-group>

			<b-form-group label="Is Adult?" label-for="isAdult" :state="validateIsAdult" valid-feedback="Thank you!">
				<b-form-select id="isAdult" v-model="post.isAdult" :options="optionsYesNo"
					></b-form-select>
			</b-form-group>

			<!-- <b-form-group label="Is Adult" v-slot="{ ariaDescribedby }">
				<b-form-radio v-model="post.isAdult" :aria-describedby="ariaDescribedby" name="isAdult"
					value="0">No</b-form-radio>
				<b-form-radio v-model="post.isAdult" :aria-describedby="ariaDescribedby" name="isAdult"
					value="1">Yes</b-form-radio>
			</b-form-group> -->

			<b-form-group label="Start Year" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`startYear`) }]"
					name="startYear" size="sm" v-model="post.startYear" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="Start Year" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`startYear`)" class="invalid-feedback">
					{{ errors.first(`startYear`) }}
				</span>
			</b-form-group>

			<b-form-group label="End Year" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`endYear`) }]" name="endYear"
					size="sm" v-model="post.endYear" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="End Year" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`endYear`)" class="invalid-feedback">
					{{ errors.first(`endYear`) }}
				</span>
			</b-form-group>

			<b-form-group label="RunTime" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`runTime`) }]" name="runTime"
					size="sm" v-model="post.runTime" type="number" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="RunTime" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`runTime`)" class="invalid-feedback">
					{{ errors.first(`runTime`) }}
				</span>
			</b-form-group>

			<b-form-group label="Genres" label-class="font-weight-bold">
				<b-form-input :class="['form-control form-control-sm', { 'is-invalid': errors.has(`genres`) }]" name="genres"
					size="sm" v-model="post.genres" type="text" v-validate="{ required: true }"
					aria-describedby="input-1-live-feedback" data-vv-as="Genres" :disabled="loading">
				</b-form-input>
				<span v-show="errors.has(`genres`)" class="invalid-feedback">
					{{ errors.first(`genres`) }}
				</span>
			</b-form-group>
		</template>

		<template #modal-footer="{ cancel }">
			<b-button size="md" variant="outline-danger" @click="cancel()" :disabled="loading">Cancel</b-button>
			<b-button size="md" variant="outline-success" @click="save()" :disabled="loading">{{ post.id ? 'Update' : 'Save'
			}}</b-button>
		</template>

	</b-modal>
</template>

<script>
export default {
	props: ['selected', 'id'],
	data() {
		return {
			loading: false,
			post: {
				id: null,
				tconst: null,
				primary: null,
				original: null,
				isAdult: 0,
				startYear: null,
				endYear: null,
				runTime: null,
				genres: null,
				_method: 'post'
			},
			optionsYesNo: [
				{ value: null, text: 'Please select an option' },
				{ value: 1, text: 'Yes' },
				{ value: 0, text: 'No' },
			],
			genres: []
		}
	},
	watch: {
		selected() {
			if (this.selected) {
				this.post.id = this.selected.id;
				this.post.tconst = this.selected.tconst;
				this.post.primary = this.selected.primary;
				this.post.original = this.selected.original;
				this.post.isAdult = this.selected.isAdult;
				this.post.startYear = this.selected.startYear;
				this.post.endYear = this.selected.endYear;
				this.post.runTime = this.selected.runTime;
				this.post.genres = this.selected.genres;
				this.post._method = 'put';
			} else {
				this.clear();
			}
		}
	},
	computed: {
		url() {
			return this.post && this.post.id ? `/${this.post.id}` : ''
		},
		validateIsAdult() {
      // Verifique se o campo isAdult foi selecionado
      if (this.post.isAdult != null && this.post.isAdult != undefined) {
        return true;
      }

			return false;
    },
	},
	methods: {
		clear() {
			this.post.id = null
			this.post.tconst = null
			this.post.primary = null
			this.post.original = null
			this.post.isAdult = null
			this.post.startYear = null
			this.post.endYear = null
			this.post.runTime = null
			this.post.genres = null
			this.post._method = 'post';

			this.$validator.reset('tconst')
			this.$validator.reset('primary')
			this.$validator.reset('original')
			this.$validator.reset('isAdult')
			this.$validator.reset('startYear')
			this.$validator.reset('endYear')
			this.$validator.reset('runTime')
			this.$validator.reset('genres')
		}
	},
	async created() {
		axios.get(process.env.MIX_BASE_URL + '/get/genres').then(res => {
			this.genres = res.data
		})
	},
}
</script>

<style scoped>
::v-deep .modal-backdrop {
	opacity: 0.5 !important;
}

::v-deep .modal-content {
	background-color: rgb(1, 24, 39) !important;
	border: 2px solid white  !important;
}

</style>
