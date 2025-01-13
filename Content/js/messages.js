import * as websocket from '../test_websocket/src/js/websocket.js';

function displayContactDiscussion(){
    let contacts = document.querySelectorAll('.contact');

    contacts.forEach(contact => {
        contact.addEventListener('click', function(){
            contactId = this.id;
            contactName = this.textContent;
            contactPfp = this.querySelector('contact-avatar').src;

            document.getElementById('current-contact').textContent = contactName;
            document.getElementById('current-contact-pfp').src = contactPfp;
        });
    });
}

function fetchMessages($contact){
    if (websocket && websocket.readyState === WebSocket.OPEN){

    }
}