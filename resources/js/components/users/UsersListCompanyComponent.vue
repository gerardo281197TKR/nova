<template>
    <div class="card">
        <div class="card-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0">
                Lista de Usuarios
            </h5>
            <form class="ms-auto position-relative">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon name="search-sharp"></ion-icon></div>
                <input class="form-control ps-5" type="text" placeholder="Buscar..">
            </form>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-middle">
            <thead class="table-secondary">
                <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo electrónico</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        b
                    </td>
                    <td>89 Chicago UK</td>
                    <td>Chicago</td>
                    <td>8574201</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</template>
<script>
export default {
  name: 'usersListCompanyComponent',
  props: {

  },
  data() {
    return {
        users: [],
        filters: {
            searchv: '',
            page: null,
            role: '' // Filtro para roles
        },
    };
  },
  mounted() {
    this.$apiAuth(axios,this.get_data);
  },
  methods: {
    get_data(page){
        if(typeof this.filters !== 'undefined'){
                if(page != null && typeof page === 'number') {
                    this.filters['page'] = page;
                }

                if(typeof searchv !== 'undefined'){
                    this.filters['searchv'] = searchv;
                }
        }
        this.users = [];
        axios.get('/api/users/show',{
            params:this.filters
        }).then(res => {
            if(res?.data?.status){
            this.users = res.data.users;
            this.getRoles();
            }
        }).catch(error => {
            console.log(error)
        })
    },
  },
  watch: {
  },
  beforeCreate() {
  },
  created() {
  },
  beforeMount() {
  },
  beforeUpdate() {
  },
  updated() {
  },
  beforeUnmount() {
  },
  unmounted() {
  }
};
</script>

<style scoped>
/* Estilos específicos del componente */
</style>
