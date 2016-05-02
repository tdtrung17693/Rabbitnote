import Vue from 'vue';
import Promise from 'promise';

export default {
	state: {
		user: {
			id: '',
			name: '',
			email: ''
		},
		notes: []
	},
	_cache: {},

	init() {
		return Vue.http.get('user', {'include': 'notes'})
				.then((response) => {
					this.state.user.id = response.data.data.id;
					this.state.user.name = response.data.data.name;
					this.state.user.email = response.data.data.email;

					this.state.notes = response.data.data.notes.data;
					
					response.data.data.notes.data.forEach(note => {
						this._cache[note.id] = note
					});

					return response;
				}, response => {
					return Promise.reject(response);
				});
	},
	login(email, password) {
		return Vue.http.post('auth', {email, password});
	},
	add(data) {
		return Vue.http.post(`users/${this.state.user.id}/notes`, data);
	},
	getAll() {
		return this._cache;
	},
	get(id) {
		return this._cache[id];
	},
	update(id, data) {
		Vue.http.put(`users/${this.state.user.id}/notes/${id}`, data)
				.then(response => {
					let note = response.data;
					
					let noteIdx = this.notes.indexOf( this._cache[ note.id ] );

					this.notes.splice(noteIdx, 1);

					this._cache[ note.id ] = note;
				});
	},
	delete(id) {
		Vue.http.put(`users/${this.state.user.id}/notes/${id}`)
				.then(response => {
					let noteIdx = this.notes.indexOf( this._cache[ note.id ] );

					this.notes.splice(noteIdx, 1);

					delete this._cache[ note.id ];
				}, () => {
					console.error(`Cannot delete note with id ${id}`);
				});
	}
}
