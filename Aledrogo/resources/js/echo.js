import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


// import Echo from "laravel-echo";
// import Pusher from "pusher-js";

// // Attach Pusher to the window object
// window.Pusher = Pusher;

// // Initialize Laravel Echo
// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY, // Ensure your .env file has the correct key
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Ensure your .env file has the correct cluster
//     forceTLS: false, // Use HTTPS for Pusher connections
// });

// console.log("echo")

// window.Echo.private(`App.Models.User.${window.User}`)
// .listen('PurchaseMade',(event) => {
//     console.log("New notification received:", event);
//     console.log("złapane");
//     // Update the UI with the notification
//     alert(`Someone bought Your listing: ${event.listingTitle}`);
// });
