document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('change-password-modal');
    const changePasswordButton = document.getElementById('change-password-button');
    const closeModal = document.getElementById('close-modal');
    const changePasswordForm = document.getElementById('change-password-form');

    // Zobrazit modal
    changePasswordButton.addEventListener('click', () => {
        modal.classList.add('visible');
    });

    // Zavřít modal
    closeModal.addEventListener('click', () => {
        modal.classList.remove('visible');
    });

    // Handle change password form submission
    changePasswordForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(changePasswordForm);
        const data = {
            oldPassword: formData.get('old-password'),
            newPassword: formData.get('new-password'),
            confirmPassword: formData.get('confirm-password')
        };

        fetch('/changePassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Password changed successfully');
                modal.classList.remove('visible');
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            alert('Check console for error');
            console.error('Error:', error);
        });
    });
});

document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    toggle.addEventListener('click', (e) => {
        e.preventDefault();
        const dropdownMenu = toggle.nextElementSibling;
        const isVisible = dropdownMenu.style.display === 'block';
        document.querySelectorAll('.dropdown-menu').forEach(menu => menu.style.display = 'none');
        dropdownMenu.style.display = isVisible ? 'none' : 'block';
    });
});

window.addEventListener('click', (e) => {
    if (!e.target.matches('.dropdown-toggle')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => menu.style.display = 'none');
    }
});

document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.previousElementSibling; // Najde předchozí input
        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = '🙈'; // Změní ikonu na zavřené oči
        } else {
            input.type = 'password';
            button.textContent = '👁️'; // Změní ikonu na otevřené oči
        }
    });
});
