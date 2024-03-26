document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("sendMessageBtn").addEventListener("click", function(e) {
        e.preventDefault();

        var form = document.getElementById("contactForm");

        var nameInput = form.querySelector('input[name="name"]');
        var emailInput = form.querySelector('input[name="email"]');
        var messageInput = form.querySelector('textarea[name="text"]');

        if (nameInput.value.trim() === "") {
            alert("Please enter your name");
            return;
        }

        if (emailInput.value.trim() === "") {
            alert("Please enter a valid email address");
            return;
        }

        if (messageInput.value.trim() === "") {
            alert("Please enter your message");
            return;
        }

        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "server.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("contactForm").innerHTML = "<p>Thank you, " + nameInput.value.trim() + ", for contacting me!</p>";
            } else {
                alert("Error: " + xhr.statusText);
            }
        };

        xhr.send(formData);
    });
});