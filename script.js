document.getElementById('sendButton').addEventListener('click', function () {
    const message = document.getElementById('messageInput').value;

    fetch('chat.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: message }) // پیام را به صورت JSON ارسال می‌کند
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Message sent successfully");
                // پیام ارسال شده با موفقیت
            } else {
                console.error("Error:", data.error);
            }
        })
        .catch(error => console.error("Error:", error));
});
