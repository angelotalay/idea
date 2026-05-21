// For the session success and failed messages

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(function () {
        const success = document.querySelector("#session-success");
        if (success) {
            success.remove();
        }
    }, 3000);

    // On click you add open-modal to the class list of the modal
    const createIdeaButton = document.querySelector("#create-idea-button");
    const createIdeaModal = document.querySelector("#create-idea-modal");

    if (!createIdeaButton || !createIdeaModal) return;

    // Show the modal on click
    createIdeaButton.addEventListener("click", () => {
        createIdeaModal.classList.remove(
            "pointer-events-none",
            "opacity-0",
            "translate-x-4",
            "translate-y-4",
            "ease-in",
        );

        createIdeaModal.classList.add("opacity-100", "ease-out");
    });

    window.addEventListener("keydown", (e) => {
        if (
            e.key === "Escape" &&
            createIdeaModal.classList.contains("opacity-100")
        ) {
            createIdeaModal.classList.remove(
                "opacity-100",
                "translate-x-0",
                "translate-y-0",
                "ease-out",
            );

            createIdeaModal.classList.add(
                "opacity-0",
                "translate-x-4",
                "translate-y-4",
                "pointer-events-none",
                "ease-in",
            );
        }
    });
});
