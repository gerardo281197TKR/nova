// utils/auth.js (por ejemplo)
import axios from 'axios';
import cookies from 'vue-cookies';
import swal from 'sweetalert2';

export function _api_auth(axios_instance, cb) {
  // Verificar si ya tenemos un token válido en cookies
  let cookie_api_token = cookies.get('api_token');
  
  if (cookie_api_token != null) {
    axios_instance.defaults.headers.Authorization = 'Bearer ' + cookie_api_token;
    if (typeof cb === 'function') {
      cb({ authorization: ('Bearer ' + cookie_api_token) });
    }
    return cookie_api_token;
  }

  // Si no hay token, solicitar uno nuevo del backend
  return axios.post('/api/generate-token')
    .then(response => {
      if (response.data.hasOwnProperty('access_token')) {
        let expires = new Date();
        expires.setDate(expires.getDate() + 15); // 15 días como configuramos en el backend

        cookie_api_token = response.data.access_token;
        cookies.set('api_token', cookie_api_token, expires, '/');
        axios_instance.defaults.headers.Authorization = 'Bearer ' + cookie_api_token;
        
        if (typeof cb === 'function') {
          cb({ authorization: ('Bearer ' + cookie_api_token) });
        }
        
        return cookie_api_token;
      } else {
        throw new Error('No se recibió token del backend');
      }
    })
    .catch(error => {
      console.error('Error al generar token:', error);
      // Si falla, podrías mostrar un mensaje de error o redirigir
      if (typeof swal !== 'undefined') {
        swal.fire({
          title: 'Error de conexión API',
          text: 'No se pudo generar el token de acceso',
          icon: 'error',
        });
      }
      throw error;
    });
}

// Función para renovar el token
export function refreshToken(axios_instance, cb) {
  return axios.post('/api/generate-token')
    .then(response => {
      if (response.data.hasOwnProperty('access_token')) {
        let expires = new Date();
        expires.setDate(expires.getDate() + 15); // 15 días

        const token = response.data.access_token;
        cookies.set('api_token', token, expires, '/');
        axios_instance.defaults.headers.Authorization = 'Bearer ' + token;
        
        if (typeof cb === 'function') {
          cb({ authorization: ('Bearer ' + token), user: response.data.user });
        }
        
        return response.data;
      }
    })
    .catch(error => {
      console.error('Error al renovar token:', error);
      throw error;
    });
}

// Función para hacer logout
export function logout(axios_instance, cb) {
  const token = cookies.get('api_token');
  
  if (token) {
    axios_instance.defaults.headers.Authorization = 'Bearer ' + token;
    
    return axios.post('/api/logout')
      .then(() => {
        cookies.remove('api_token');
        delete axios_instance.defaults.headers.Authorization;
        
        if (typeof cb === 'function') {
          cb();
        }
      })
      .catch(error => {
        console.error('Logout error:', error);
        // Aún así removemos el token local
        cookies.remove('api_token');
        delete axios_instance.defaults.headers.Authorization;
      });
  }
}

// Función para verificar si el token es válido
export function isTokenValid() {
  const token = cookies.get('api_token');
  return token !== null && token !== undefined;
}

// Función para obtener el token actual
export function getCurrentToken() {
  return cookies.get('api_token');
}
