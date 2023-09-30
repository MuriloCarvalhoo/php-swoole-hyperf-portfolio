<template>
	<div class="mt-4">
		<div class="col-12">
			<div v-if="loading" class="mb-5">
				<h1 class="d-flex justify-content-center loading">Loading...</h1>
				<div class="progress mt-5">
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
						aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
				</div>
			</div>

			<div class="card" v-show="!loading">
				<div class="card-header">
					<div class="col-12 d-flex justify-content-between">
						<h5>Listing Title in MariaDB</h5>
						<a :href="baseUrl" class="btn btn-md btn-primary"> Home</a>
						<button type="button" class="btn btn-sm btn-success" @click="showForm(null)">Create Movie</button type="button">

					</div>
				</div>
				<div class="card-body pb-2">
					<div class="row mb-5">
						<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
							<div class="input-group mb-2">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
								<input type="text" class="form-control" placeholder="Search from TConst..." v-model="tconst">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
							<div class="input-group mb-2">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
								<input type="text" class="form-control" placeholder="Search from Primary..." v-model="primary">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
							<div class="input-group mb-2">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
								<input type="text" class="form-control" placeholder="Search from Original..." v-model="original">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
							<div class="input-group mb-2">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
								<b-form-select v-model="isAdult" :options="optionsYesNo" class="form-select"></b-form-select>

							</div>
						</div>

						<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
							<div class="input-group mb-2">
								<button type="button" class="btn btn-md btn-primary" @click="get()">SEARCH</button>
							</div>
						</div>
					</div>


					<div class="table-responsive scroll" ref="scroll" v-show="!loading">
						<table class="table table-sm table-striped table-hover table-bordered">
							<thead style="" class="text-white">
								<tr style="" class="text-white">
									<th class="align-middle text-center" width="5%">Id</th>
									<th class="align-middle text-center" width="10%">TConst</th>
									<th class="align-middle text-center" width="10%">Primary</th>
									<th class="align-middle text-center" width="10%">Original</th>
									<th class="align-middle text-center" width="10%">Is Adult</th>
									<th class="align-middle text-center" width="10%">Start Year</th>
									<th class="align-middle text-center" width="10%">End Year</th>
									<th class="align-middle text-center" width="10%">Runtime</th>
									<th class="align-middle text-center" width="10%">Genres</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(registro, index) in registros" :key="index">
									<td class="align-middle text-center">
										{{
											registro && registro.id ? registro.id : "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.tconst
											? registro.tconst
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.primary
											? registro.primary
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.original
											? registro.original
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.is_adult && registro.is_adult == 1
											? "Yes"
											: "No"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.start_year
											? registro.start_year
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.end_year
											? registro.end_year
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										{{
											registro && registro.runtime
											? registro.runtime
											: "No information"
										}}
									</td>
									<td class="align-middle text-center">
										<div v-if="registro &&
												registro.genres &&
												registro.genres.length > 0
												">
											<span v-for="(genre, index) in registro.genres" :key="index">
												{{ genre.name }}
											</span>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<p class="mt-3" v-show="!loading">Current Page: {{ currentPage }}</p>

					<b-pagination v-show="!loading" v-model="currentPage" :total-rows="rows" :per-page="10"
						@change="clickPagination($event)"></b-pagination>

				</div>
			</div>
		</div>
		<notifications group="submit" position="center bottom" />
		<form-title @store="store($event)" @update="update($event)" :selected="selected"></form-title>
	</div>
</template>

<script>
import debounce from "debounce";
import moment from "moment";
import ListingMixin from "../../shared/ListingMixin";
import { ModalPlugin } from "bootstrap-vue";

export default {
	mixins: [ListingMixin],
	components: {
	    FormTitle: () => import('./FormTitle'),
	    // DeleteModal: () => import('../../shared/components/DeleteModal'),
	},
	data() {
		return {
			value: 100,
			max: 100,
			page: "titles",
			baseUrl: process.env.MIX_BASE_URL,
			loading: true,
			tconst: null,
			primary: null,
			original: null,
			isAdult: null,
			startYear: null,
			endYear: null,
			runtimeMinutes: null,
			genres: null,
			selected: null,
			optionsYesNo: [
				{ value: null, text: 'Please select an option' },
				{ value: 1, text: 'Yes' },
				{ value: 0, text: 'No' },
			]
		};
	},
	methods: {
		showForm(registro) {
			this.selected = registro;
			this.$bvModal.show("formModal");
		},
		showDelete(registro) {
			this.toDelete = registro;
			this.$bvModal.show("deleteModal");
		},
		store($event) {
			this.registros.splice(0, 0, $event);
			this.$bvModal.hide("formModal");
			this.total++;
		},
		update($event) {
			let index = this.registros.findIndex(
				(registro) => registro.id == this.selected.id
			);
			this.registros.splice(index, 1, $event);
			this.$bvModal.hide("formModal");
		},
		async destroy() {
			await axios
				.delete(`${process.env.MIX_BASE_URL}/${this.page}/${this.toDelete.id}`)
				.then((res) => {
					if (res.status == 200) {
						let index = this.registros.findIndex(
							(registro) => registro.id == this.toDelete.id
						);
						this.registros.splice(index, 1);
						this.total--;
						axios
							.get(this.url.concat(`&page=${this.currentPage}`))
							.then((res) => {
								const toFilter = [...this.registros, ...res.data.data];
								const filtered = toFilter.reduce((items, current) => {
									const x = items.find((item) => item.id === current.id);
									return !x ? items.concat([current]) : items;
								}, []);
								this.registros = filtered;
								this.currentPage = res.data.current_page;
							});
						this.$notify({
							group: "submit",
							title: "Sucesso!",
							text: "registro removido.",
							type: "success",
						});
					}
				})
				.catch((error) => {
					if (error.response.status == 422) {
						if (
							error.response.data.message == "The given registro was invalid."
						) {
							this.$notify({
								group: "submit",
								title: "Erro no cadastro",
								text: "Campos obrigatórios não preenchidos.",
								type: "error",
							});
						}
					}
					if (error.response.status == 403) {
						if (error.response.data.message == "This action is unauthorized.") {
							this.$notify({
								group: "submit",
								title: "Erro!",
								text: "Ação não autorizada.",
								type: "error",
							});
						}
					}
				});
		},
	},
};
</script>
