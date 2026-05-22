document.addEventListener("DOMContentLoaded", () => {
    const statusButtons = document.querySelectorAll(".status-button");
    const statusInput = document.querySelector("#status-input");

    statusButtons.forEach((button) => {
        button.addEventListener("click", () => {
            statusInput.value = button.value;

            statusButtons.forEach((button) => {
                if (button.value === statusInput.value) {
                    button.classList.add("bg-primary");
                } else {
                    button.classList.remove("bg-primary");
                }
            });
        });
    });
});
