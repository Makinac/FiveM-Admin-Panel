document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login-form");
    const togglePasswordButtons = document.querySelectorAll(".toggle-password");
    const loginButton = loginForm.querySelector("button[type='submit']");

    // Toggle password visibility
    togglePasswordButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const input = button.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "🙈";
            } else {
                input.type = "password";
                button.textContent = "👁️";
            }
        });
    });

    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();
        loginButton.disabled = true;

        const formData = new FormData(loginForm);

        const data = {
            username: formData.get('username'),
            password: formData.get('password')
        };

        fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
        .then(data => {
            console.log(data.status);
          if (data.status === "success") {
              window.location.href = "/dashboard";
          } else {
              alert(data.message);
              loginButton.disabled = false;
          }
        })
        .catch((error) => {
            alert("Check console for error");
            console.error('Error:', error);
            loginButton.disabled = false;
        });
    });
});
