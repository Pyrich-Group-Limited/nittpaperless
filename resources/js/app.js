import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// window.Echo.join(`chat-room`)
//     .listen('MessageSent', (event) => {
//         console.log("New message received:", event);

//         let chatBox = document.getElementById('chat-box');
//         let messageElement = document.createElement('div');
//         messageElement.innerHTML = `<strong>${event.user}:</strong> ${event.message}`;
//         chatBox.appendChild(messageElement);
//     });
