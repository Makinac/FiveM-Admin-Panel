document.addEventListener("DOMContentLoaded", () => {
    const steps = document.querySelectorAll(".step");
    const setupFrames = document.querySelectorAll(".setup-frame");
    const nextButtons = document.querySelectorAll(".next");
    const backButtons = document.querySelectorAll(".back");
    const frameworkOptions = document.querySelectorAll(".framework-option");
    const frameworkForm = document.querySelector("#setup-1");
    const dbFrameworkForm = document.querySelector("#db-framework-form");
    const accountForm = document.querySelector("#account-form");
    const togglePasswordButtons = document.querySelectorAll(".toggle-password");
    const submitButton = document.querySelector("#submit");

    let currentStep = 0;

    // Aktualizace progress baru
    function updateProgressBar() {
        steps.forEach((step, index) => {
            if (index < currentStep) {
                step.classList.add("completed");
                step.classList.remove("active");
            } else if (index === currentStep) {
                step.classList.add("active");
                step.classList.remove("completed");
            } else {
                step.classList.remove("active", "completed");
            }
        });
    }

    // Zobrazení správného kroku
    function showStep(stepIndex) {
        setupFrames.forEach((frame, index) => {
            frame.classList.toggle("active", index === stepIndex);
        });
    }

    // Enable or disable the "Next" button based on form validation
    function validateForm() {
        if (currentStep === 0) {
            const selectedFramework = document.querySelector(".framework-option.selected");
            nextButtons[0].disabled = !selectedFramework;
        } else if (currentStep === 1) {
            nextButtons[1].disabled = !dbFrameworkForm.checkValidity();
        } else if (currentStep === 2) {
            nextButtons[2].disabled = !accountForm.checkValidity();
        }
    }

    // Další krok
    nextButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                updateProgressBar();
                showStep(currentStep);
                validateForm();
            }
        });
    });

    // Předchozí krok
    backButtons.forEach((button) => {
        button.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                updateProgressBar();
                showStep(currentStep);
                validateForm();
            }
        });
    });

    // Handle framework option selection
    frameworkOptions.forEach((option) => {
        option.addEventListener("click", () => {
            frameworkOptions.forEach((opt) => opt.classList.remove("selected"));
            option.classList.add("selected");
            validateForm();
        });
    });

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

    // Collect form data and send to controller
    submitButton.addEventListener("click", () => {
        const selectedFramework = document.querySelector(".framework-option.selected").dataset.framework;
        const dbFrameworkData = new FormData(dbFrameworkForm);
        const accountData = new FormData(accountForm);

        const data = {
            framework: selectedFramework,
            dbFramework: Object.fromEntries(dbFrameworkData.entries()),
            account: Object.fromEntries(accountData.entries())
        };

        fetch('/creator', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
          .then(data => {
            if (data.status === "success") {
                window.location.href = "/login";
            } else {
                alert(data.message);
            }
          })
          .catch((error) => {
              alert("Check console for error");
              console.error('Error:', error);
          });
    });

    // Validate forms on input change
    dbFrameworkForm.addEventListener("input", validateForm);
    accountForm.addEventListener("input", validateForm);

    // Inicializace
    updateProgressBar();
    showStep(currentStep);
    validateForm();
});
