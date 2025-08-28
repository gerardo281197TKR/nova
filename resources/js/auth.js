// utils/auth.js (por ejemplo)
import axios from 'axios';
import cookies from 'vue-cookies';
import swal from 'sweetalert2';

export function _api_auth(axios_instance, cb) {
  // obtenemos parametros de la url
  const valores = window.location.search;
  // Creamos la instancia
  const urlParams = new URLSearchParams(valores);
  // Accedemos a los valores
  const find_tag = urlParams.get('rt');

  if (find_tag) {
    let cookie_api_token = cookies.get('api_token');
    axios.post('/oauth/personal-access-tokens', {
      name: 'app-client',
    }).then(response => {
      if (response.data.hasOwnProperty('token')) {
        let expires = new Date(response.data.token.expires_at);
        let mzone = expires.getTimezoneOffset();
        expires = (new Date(expires.toUTCString())).getTime() - ((mzone * (60 * 1000)));

        cookie_api_token = response.data.accessToken;
        cookies.set('api_token', response.data.accessToken, expires, '/');
        axios_instance.defaults.headers.Authorization = 'Bearer ' + response.data.accessToken;
        if (typeof cb === 'function') {
          cb({ authorization: ('Bearer ' + response.data.accessToken) });
        }
      } else {
         this.$swal.fire({
          title: 'API access error not allowed',
          icon: "error",
        });
      }
    }).catch(response => {
       this.$swal.fire({
        title: 'API connection error',
        icon: "error",
      });
    });
  }

  let cookie_api_token = cookies.get('api_token');
  if (cookie_api_token != null) {
    axios_instance.defaults.headers.Authorization = 'Bearer ' + cookie_api_token;
    if (typeof cb === 'function') {
      cb({ authorization: ('Bearer ' + cookie_api_token) });
    }
  } else {
    axios_instance.post('/oauth/personal-access-tokens', {
      name: 'app-client',
    }).then(response => {
      if (response.data.hasOwnProperty('token')) {
        let expires = new Date(response.data.token.expires_at);
        let mzone = expires.getTimezoneOffset();
        expires = (new Date(expires.toUTCString())).getTime() - ((mzone * (60 * 1000)));

        cookie_api_token = response.data.accessToken;
        cookies.set('api_token', response.data.accessToken, expires, '/');
        axios_instance.defaults.headers.Authorization = 'Bearer ' + response.data.accessToken;
        if (typeof cb === 'function') {
          cb({ authorization: ('Bearer ' + response.data.accessToken) });
        }
      } else {
         this.$swal.fire({
          title: 'API access error not allowed',
          icon: "error",
        });
      }
    }).catch(response => {
      console.log(response)
       this.$swal.fire({
        title: 'API connection error',
        icon: "error",
      });
    });
  }

  return cookie_api_token;
}
