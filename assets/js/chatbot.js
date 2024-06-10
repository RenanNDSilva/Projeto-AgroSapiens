const messages = document.getElementById('messages');
const initialMessage = document.createElement('div');
initialMessage.classList.add('message', 'bot');
initialMessage.textContent = 'Olá! Eu sou o ÁgilSapiens, seu assistente virtual. Como posso ajudar você hoje?';
messages.appendChild(initialMessage);

function sendMessage() {
    const userInput = document.getElementById('userInput').value;
    if (userInput.trim() === '') return;

    const userMessage = document.createElement('div');
    userMessage.classList.add('message', 'user');
    userMessage.textContent = userInput;
    messages.appendChild(userMessage);

    fetch('chatbot.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: userInput })
    })
        .then(response => response.json())
        .then(data => {
            const botMessage = document.createElement('div');
            botMessage.classList.add('message', 'bot');
            botMessage.textContent = data.response;
            messages.appendChild(botMessage);
            messages.scrollTop = messages.scrollHeight;
        })
        .catch(error => console.error('Erro:', error));

    document.getElementById('userInput').value = '';
}

function handleKeyDown(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}