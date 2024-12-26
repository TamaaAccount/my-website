document.getElementById('send-btn').addEventListener('click', async () => {
    const userInput = document.getElementById('user-input').value;
    if (!userInput.trim()) return;

    // GAUSAH NYOLONG BG


    appendMessage('user', userInput);
    document.getElementById('user-input').value = '';

    // LenwyLD
    const typingBubble = appendTypingBubble();

    await fetchAIResponse(userInput, typingBubble);
});

function appendMessage(sender, message) {
    const chatBox = document.getElementById('chat-box');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', sender);
    messageElement.innerHTML = `<div class="bubble2">${message}</div>`;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function appendTypingBubble() {
    const chatBox = document.getElementById('chat-box');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', 'ai'); // Pesan Kiri
    messageElement.innerHTML = `<div class="bubble"></div>`;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
    return messageElement; // Ganti Pesan Zhizi
}

async function fetchAIResponse(message, typingBubble) {
    try {
        const response = await fetch(`https://restapi.yanzoffc.xyz/ai4chat?text=${encodeURIComponent(message)}`);
        const data = await response.json();

        // Setelah LenwyLD
        typingBubble.remove();

        appendMessage('ai', data.data || 'No response received');
    } catch (error) {
        typingBubble.remove();
        appendMessage('ai', 'Error: Unable to connect to the API');
        console.error('API Error:', error);
    }
}

document.getElementById('user-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('send-btn').click();
    }
});