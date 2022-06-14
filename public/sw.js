// // Install service worker
// // Fungsi js
// self.addEventListener('install', evt => {
//   console.log('service worker has been installed');
// });

// // Activate sercive worker
// self.addEventListener('activate', evt => {
//   console.log('service worker has been activated');
// });

// // Fetch even = untuk mengambil file asset yang di akses untuk dijadikan offline
// self.addEventListener('fetch', evt => {
//   // console.log('fetch event', evt);
// });



const CACHE_NAME = 'CACHE-01';
const toCache = [
    '/',
    'manifest.json',
    'js/pwa.js',
    'bkpp.ico',
];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(function(cache) {
            return cache.addAll(toCache)
        })
        .then(self.skipWaiting())
    )
})

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request)
        .catch(() => {
            return caches.open(CACHE_NAME)
            .then((cache) => {
                return cache.match(event.request)
            })
        })
    )
})

self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys()
        .then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log('Hapus cache lama', key)
                    return caches.delete(key)
                }
            }))
        })
        .then(() => self.clients.claim())
    )
})