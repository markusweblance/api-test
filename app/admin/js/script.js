const App = {
	data() {
		return {
			cities: [],
			city: [],
			status: '',
			city_active: false,
			isReady: false,
			city_title: '',
			city_response: '',
			city_rename: ''
		}
	},
	mounted() {
		this.isReady = true
		this.getCities();
	},
	methods: {
		async getCity(id){
			await fetch('https://test-8823.h1n.ru/api/city/' + id + '')
				.then(response => response.json())
				.then(json => {
					this.city = json
					this.status = 'city'
					this.city_active = true
				})
		},
		async getCities(){
			this.city_rename = '';
			let res = await fetch('https://test-8823.h1n.ru/api/city');
            if (res !== null) {
                let json = await res.json();
                this.cities = json;
                this.status = 'cities'
                this.city_active = true
            }
		},
		addCity(){
			this.status = 'addCity'
			this.city_response = ''
		},
		async addCitybase(){
			this.city_response = '';
			await fetch('https://test-8823.h1n.ru/api/city', {
				method: 'POST',
				body: JSON.stringify({title: this.city_title})
			}).then(res => res.json())
				.then(data => this.city_response = data);
			this.city_title = '';
			setTimeout(() => this.status = 'cities', 1500);
			setTimeout(() => this.getCities(), 1500);
		},
        async changeCity(id, title){
            this.city.title = '';
            await fetch('https://test-8823.h1n.ru/api/city', {
                method: 'PATCH',
                body: JSON.stringify({id: id, title: title})
            }).then(res => res.json())
                .then(data => {
                	this.city.title= data
					this.city_rename = data
                })
        },
		async deleteCity(id){
			let res = await fetch('https://test-8823.h1n.ru/api/city', {
				method: 'DELETE',
				body: JSON.stringify({id: id})
			});
			if (res){
				this.city = '';
				this.status = 'cities';
				await this.getCities();
			}
		}
	}
}

Vue.createApp(App).mount('#content')