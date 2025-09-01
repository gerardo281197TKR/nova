<template>
  <div class="create-user-component">
    <!-- Información del plan -->
    <div class="plan-info mb-4 p-3 bg-light rounded">
      <h6 class="mb-2">Información del Plan</h6>
      <div class="row">
        <div class="col-md-4">
          <small class="text-muted">Plan actual:</small>
          <div class="fw-bold">{{ companyInfo?.plan?.name || 'Cargando...' }}</div>
        </div>
        <div class="col-md-4">
          <small class="text-muted">Usuarios actuales:</small>
          <div class="fw-bold">{{ companyInfo?.currentUsers || 0 }} / {{ companyInfo?.plan?.maxUsers || 0 }}</div>
        </div>
        <div class="col-md-4">
          <small class="text-muted">Espacios disponibles:</small>
          <div class="fw-bold" :class="remainingSlots > 0 ? 'text-success' : 'text-danger'">
            {{ remainingSlots || 0 }}
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario de creación -->
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Crear Nuevo Usuario</h5>
      </div>
      <div class="card-body">
        <form @submit.prevent="createUser" v-if="canCreateUser">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName" class="form-label">Nombre *</label>
              <input 
                type="text" 
                class="form-control" 
                id="firstName" 
                v-model="form.firstName"
                :class="{ 'is-invalid': errors.firstName }"
                required
              >
              <div class="invalid-feedback" v-if="errors.firstName">
                {{ errors.firstName[0] }}
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="lastName" class="form-label">Apellido *</label>
              <input 
                type="text" 
                class="form-control" 
                id="lastName" 
                v-model="form.lastName"
                :class="{ 'is-invalid': errors.lastName }"
                required
              >
              <div class="invalid-feedback" v-if="errors.lastName">
                {{ errors.lastName[0] }}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email *</label>
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                v-model="form.email"
                :class="{ 'is-invalid': errors.email }"
                required
              >
              <div class="invalid-feedback" v-if="errors.email">
                {{ errors.email[0] }}
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="roleId" class="form-label">Rol *</label>
              <select 
                class="form-select" 
                id="roleId" 
                v-model="form.roleId"
                :class="{ 'is-invalid': errors.roleId }"
                required
              >
                <option value="">Seleccionar rol</option>
                <option v-for="role in roles" :key="role.id" :value="role.id">
                  {{ role.name }}
                </option>
              </select>
              <div class="invalid-feedback" v-if="errors.roleId">
                {{ errors.roleId[0] }}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Contraseña *</label>
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                v-model="form.password"
                :class="{ 'is-invalid': errors.password }"
                minlength="8"
                required
              >
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
              <input 
                type="password" 
                class="form-control" 
                id="password_confirmation" 
                v-model="form.password_confirmation"
                :class="{ 'is-invalid': errors.password_confirmation }"
                minlength="8"
                required
              >
              <div class="invalid-feedback" v-if="errors.password_confirmation">
                {{ errors.password_confirmation[0] }}
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
              {{ loading ? 'Creando...' : 'Crear Usuario' }}
            </button>
          </div>
        </form>

        <!-- Mensaje cuando no se pueden crear usuarios -->
        <div v-else class="text-center py-4">
          <div class="text-danger mb-3">
            <i class="fas fa-exclamation-triangle fa-2x"></i>
          </div>
          <h6 class="text-danger">No puedes crear más usuarios</h6>
          <p class="text-muted">Has alcanzado el límite de usuarios de tu plan actual.</p>
          <a href="/company/plan" class="btn btn-outline-primary">Actualizar Plan</a>
        </div>
      </div>
    </div>

    <!-- Alertas -->
    <div v-if="alert.show" class="alert mt-3" :class="alert.type">
      {{ alert.message }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'CreateUserComponent',
  data() {
    return {
      companyInfo: {},
      roles: [],
      form: {
        firstName: '',
        lastName: '',
        email: '',
        roleId: '',
        password: '',
        password_confirmation: ''
      },
      errors: {},
      loading: false,
      alert: {
        show: false,
        type: 'alert-success',
        message: ''
      }
    }
  },
  computed: {
    canCreateUser() {
      return this.companyInfo.canAddUser !== false;
    },
    remainingSlots() {
      return this.companyInfo.remainingSlots || 0;
    }
  },
  async mounted() {
    await this.loadCompanyInfo();
    await this.loadRoles();
  },
  methods: {
    async loadCompanyInfo() {
      try {
        const response = await window.axios.get('/users/company-info');
        this.companyInfo = response.data.company;
      } catch (error) {
        console.error('Error cargando información de la empresa:', error);
        this.showAlert('Error cargando información de la empresa', 'alert-danger');
      }
    },
    
    async loadRoles() {
      try {
        // Aquí podrías hacer una llamada API para obtener los roles
        // Por ahora usamos roles básicos
        this.roles = [
          { id: 2, name: 'Manager' },
          { id: 3, name: 'Usuario' }
        ];
      } catch (error) {
        console.error('Error cargando roles:', error);
      }
    },
    
    async createUser() {
      this.loading = true;
      this.errors = {};
      this.alert.show = false;
      
      try {
        const response = await window.axios.post('/users/store', this.form);
        
        if (response.status === 201) {
          this.showAlert('Usuario creado exitosamente', 'alert-success');
          this.resetForm();
          await this.loadCompanyInfo(); // Recargar información de la empresa
        }
      } catch (error) {
        console.error('Error creando usuario:', error);
        
        if (error.response && error.response.data) {
          if (error.response.data.errors) {
            this.errors = error.response.data.errors;
          }
          this.showAlert(error.response.data.message || 'Error al crear el usuario', 'alert-danger');
        } else {
          this.showAlert('Error de conexión', 'alert-danger');
        }
      } finally {
        this.loading = false;
      }
    },
    
    resetForm() {
      this.form = {
        firstName: '',
        lastName: '',
        email: '',
        roleId: '',
        password: '',
        password_confirmation: ''
      };
      this.errors = {};
    },
    
    showAlert(message, type = 'alert-success') {
      this.alert = {
        show: true,
        type,
        message
      };
      
      // Ocultar alerta después de 5 segundos
      setTimeout(() => {
        this.alert.show = false;
      }, 5000);
    }
  }
}
</script>

<style scoped>
.create-user-component {
  max-width: 800px;
  margin: 0 auto;
}

.plan-info {
  border-left: 4px solid #007bff;
}

.invalid-feedback {
  display: block;
}
</style> 