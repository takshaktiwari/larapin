importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

if (workbox) {
  console.log(`Yay! Workbox is loaded`);
} else {
  console.log(`Boo! Workbox didn't load`);
}

/*workbox.routing.registerRoute(
  new RegExp('/.*'),
  new workbox.strategies.StaleWhileRevalidate({
  	cacheName: 'pages-all-cache',
  })
);*/


/*workbox.routing.registerRoute(
  /.*(?:googleapis|gstatic|fontawesome)\.com/,
  new workbox.strategies.CacheFirst({
  	cacheName: 'cdn-cache',
  })
);
*/


workbox.routing.registerRoute(
  // Cache JS files.
  /\.js$/,
  // Use cache but update in the background.
  new workbox.strategies.CacheFirst({
    // Use a custom cache name.
    cacheName: 'js-cache',
  })
);


workbox.routing.registerRoute(
  // Cache CSS files.
  /\.css$/,
  // Use cache but update in the background.
  new workbox.strategies.CacheFirst({
    // Use a custom cache name.
    cacheName: 'css-cache',
  })
);

workbox.routing.registerRoute(
  // Cache image files.
  /\.(?:png|jpg|jpeg|svg|gif)$/,
  // Use the cache if it's available.
  new workbox.strategies.CacheFirst({
    // Use a custom cache name.
    cacheName: 'image-cache',
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        // Cache only 20 images.
        maxEntries: 200,
        // Cache for a maximum of a week.
        maxAgeSeconds: 7 * 24 * 60 * 60,
      })
    ],
  })
);


