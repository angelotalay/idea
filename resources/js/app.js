import "./createIdeaForm.js";
// For the session success and failed messages
document.addEventListener("DOMContentLoaded", () => {
    setTimeout(function () {
        const success = document.querySelector("#session-success");
        if (success) {
            success.remove();
        }
    }, 3000);
});
