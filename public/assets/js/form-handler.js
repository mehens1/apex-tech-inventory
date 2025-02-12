document.addEventListener("DOMContentLoaded", function () {
    let forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (event) {
            let submitButton = form.querySelector("[data-submit-btn]");
            if (submitButton) {
                let spinner = submitButton.querySelector(".spinner");
                let buttonText = submitButton.querySelector(".btn-text");

                // Disable button and show spinner
                submitButton.disabled = true;
                spinner.classList.remove("d-none");
                buttonText.textContent = submitButton.getAttribute("data-loading-text") || "Processing...";
            }
        });
    });
});
