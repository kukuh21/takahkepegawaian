// // Cek apakah browser support service woker, navigator adalah objek javascript untuk cek serviceworker di browser
// if('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('/sw.js')
//   // Arrow function js
//   // Jika berhasil, reg object untuk menampilkan data service worker
//   .then((reg) => console.log('service worker registered', reg))
//   // Jika gagal nampilkan data err
//   .catch((err) => console.log('service worker not registered', err));
// }

document.addEventListener('DOMContentLoaded', init, false);

function init() {
    if ('serviceWorker' in navigator && navigator.onLine) {
        navigator.serviceWorker.register('/sw.js')
        .then((reg) => {
            console.log('Registrasi service worker Berhasil', reg);
        }, (err) => {
            console.error('Registrasi service worker Gagal', err);
        });
    }
}