import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
    vus:20, // Número de usuarios virtuales
    duration: '1m', // Duración total de la prueba
};

export default function () {
    let res = http.get('http://127.0.0.1:8000'); // Cambia por la URL de tu Laravel local
    check(res, {
        'respuesta OK': (r) => r.status === 200,
    });
    sleep(1); // Espera de 1 segundo entre repeticiones
}
