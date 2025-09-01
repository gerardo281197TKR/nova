<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Lista de Usuarios</h5>

        <!-- Buscador a la derecha -->
        <form class="position-relative ms-3" @submit.prevent="get_data">
          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
            <ion-icon name="search-sharp"></ion-icon>
          </div>
          <input 
            class="form-control ps-5" 
            type="text" 
            placeholder="Buscar.." 
            v-model="filters.searchv"
            @keyup.enter="get_data" 
          />
        </form>
      </div>

      <!-- Paginado a la izquierda -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <Bootstrap5Pagination 
            :data="users" 
            @pagination-change-page="get_data" 
          />
        </div>
        <!-- Opcional: espacio vacío a la derecha para alinear -->
        <div></div>
      </div>

      <!-- Tabla -->
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-secondary">
            <tr>
              <th class="text-center">#</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Correo electrónico</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users.data" :key="user.id">
              <td class="text-center">{{ index + 1 }}</td>
              <td>{{ user.firstName }}</td>
              <td>{{ user.lastName }}</td>
              <td>{{ user.email }}</td>
              <td class="text-center">8574201</td>
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
