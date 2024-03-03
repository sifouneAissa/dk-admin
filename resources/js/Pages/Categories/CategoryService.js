export const CategoryService = {
    getData() {
        return [];
    },

    getCustomersSmall() {
        return Promise.resolve(this.getData().slice(0, 10));
    },

    getCustomersMedium() {
        return Promise.resolve(this.getData().slice(0, 50));
    },

    getCustomersLarge() {
        return Promise.resolve(this.getData().slice(0, 200));
    },

    getCustomersXLarge() {
        return Promise.resolve(this.getData());
    },

    getCategories(params) {
        const queryParams = params
            ? Object.keys(params)
                  .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                  .join('&')
            : '';

        return fetch('http://localhost:8000/admin-dash/category/list?' + queryParams).then((res) => res.json());
    },

    getSelect(){
        return Promise.resolve(fetch('http://localhost:8000/admin-dash/category/list?forSelect=1').then((res) => res.json()));
    }
};
