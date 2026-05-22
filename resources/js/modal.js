function closeEventHandler(modalElement) {
    modalElement.classList.remove(
        "opacity-100",
        "translate-x-0",
        "translate-y-0",
        "ease-out",
    );

    modalElement.classList.add(
        "opacity-0",
        "translate-x-4",
        "translate-y-4",
        "pointer-events-none",
        "ease-in",
    );
}

function openEventHandler(modalElement) {
    modalElement.classList.remove(
        "pointer-events-none",
        "opacity-0",
        "translate-x-4",
        "translate-y-4",
        "ease-in",
    );

    modalElement.classList.add(
        "opacity-100",
        "translate-x-0",
        "translate-y-0",
        "ease-out",
    );
}

function registerModal(openButtonSelector, modalSelector) {
    const openButton = document.querySelector(openButtonSelector);
    const modal = document.querySelector(modalSelector);

    if (!openButton || !modal) {
        return;
    }

    const closeButton = modal.querySelector("#cancel-idea-modal-button");

    openButton.addEventListener("click", () => {
        openEventHandler(modal);
    });

    closeButton?.addEventListener("click", () => {
        closeEventHandler(modal);
    });
}

function registerEscapeKeyHandler() {
    window.addEventListener("keydown", (e) => {
        if (e.key !== "Escape") {
            return;
        }

        const openModal = document.querySelector(".opacity-100");

        if (!openModal) {
            return;
        }

        closeEventHandler(openModal);
    });
}

function registerStatusButtons(form) {
    const statusButtons = form.querySelectorAll(".status-button");
    const statusInput = form.querySelector("#status-input");

    if (!statusButtons.length || !statusInput) {
        return;
    }

    function setSelectedStatusButton(selectedButton) {
        statusButtons.forEach((statusButton) => {
            statusButton.classList.remove("btn-primary");
            statusButton.classList.add("btn-outlined");
        });

        selectedButton.classList.remove("btn-outlined");
        selectedButton.classList.add("btn-primary");
    }

    const currentStatusButton = Array.from(statusButtons).find((button) => {
        return button.value === statusInput.value;
    });

    if (currentStatusButton) {
        setSelectedStatusButton(currentStatusButton);
    }

    statusButtons.forEach((button) => {
        button.addEventListener("click", () => {
            statusInput.value = button.value;
            setSelectedStatusButton(button);
        });
    });
}
function createRemoveButton() {
    const removeButton = document.createElement("button");

    removeButton.type = "button";
    removeButton.className =
        "btn btn-outlined shrink-0 text-red-500 remove-row-button";
    removeButton.textContent = "Remove";

    return removeButton;
}

function registerAddLink(form) {
    const addLinkButton = form.querySelector("#add-link-button");
    const newLinkInput = form.querySelector("#new-link-input");
    const linksContainer = form.querySelector("#links-container");

    if (!addLinkButton || !newLinkInput || !linksContainer) {
        return;
    }

    addLinkButton.addEventListener("click", () => {
        const link = newLinkInput.value.trim();

        if (link === "") {
            return;
        }

        const linkRow = document.createElement("div");
        linkRow.className =
            "repeatable-row flex items-center justify-between gap-x-2 rounded-md border border-muted-foreground/30 p-2";

        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "links[]";
        hiddenInput.value = link;

        const linkAnchor = document.createElement("a");
        linkAnchor.href = link;
        linkAnchor.target = "_blank";
        linkAnchor.rel = "noopener noreferrer";
        linkAnchor.className = "truncate text-sm underline";
        linkAnchor.textContent = link;

        const removeButton = createRemoveButton();
        linkRow.appendChild(hiddenInput);
        linkRow.appendChild(linkAnchor);
        linkRow.appendChild(removeButton);

        linksContainer.appendChild(linkRow);

        newLinkInput.value = "";
        newLinkInput.focus();
    });
}

function registerAddStep(form) {
    const addStepButton = form.querySelector("#add-step-button");
    const newStepInput = form.querySelector("#new-step-input");
    const stepsContainer = form.querySelector("#steps-container");

    if (!addStepButton || !newStepInput || !stepsContainer) {
        return;
    }

    addStepButton.addEventListener("click", () => {
        const step = newStepInput.value.trim();

        if (step === "") {
            return;
        }

        const stepRow = document.createElement("div");
        stepRow.className =
            "repeatable-row flex items-center justify-between gap-x-2 rounded-md border border-muted-foreground/30 p-2";

        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "steps[]";
        hiddenInput.value = step;

        const stepText = document.createElement("p");
        stepText.className = "truncate text-sm underline";
        stepText.textContent = step;

        const removeButton = createRemoveButton();
        stepRow.appendChild(hiddenInput);
        stepRow.appendChild(stepText);
        stepRow.appendChild(removeButton);

        stepsContainer.appendChild(stepRow);

        newStepInput.value = "";
        newStepInput.focus();
    });
}

function registerRemoveButtons(form) {
    form.addEventListener("click", (event) => {
        const removeButton = event.target.closest(".remove-row-button");

        if (!removeButton) {
            return;
        }

        removeButton.closest(".repeatable-row")?.remove();
    });
}

function registerIdeaForm(form) {
    registerStatusButtons(form);
    registerAddLink(form);
    registerAddStep(form);
    registerRemoveButtons(form);
}

document.addEventListener("DOMContentLoaded", () => {
    registerModal("#create-idea-button", "#create-idea-modal");
    registerModal("#edit-idea-button", "#edit-idea-modal");

    registerEscapeKeyHandler();

    document.querySelectorAll("form").forEach((form) => {
        if (
            form.querySelector("#add-link-button") ||
            form.querySelector("#add-step-button")
        ) {
            registerIdeaForm(form);
        }
    });
});
