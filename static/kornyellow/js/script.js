const tooltipTriggerList = document.querySelectorAll("[data-bs-toggle='tooltip']")
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, {boundary: document.body}))

let forms = document.querySelectorAll("form");
forms.forEach((form) => {
    let submit_button = form.querySelector("button[name='submit']");
    form.addEventListener("submit", () => {
        submit_button.innerHTML = "<i class='fa-solid fa-spinner fa-spin fa-fw me-2'></i>กำลังดำเนินการ";
        submit_button.classList.add("fake-disable");
    });
});

let nav_buttons = document.querySelectorAll(".nav-link:not(.dropdown-toggle)");
nav_buttons.forEach((element) => {
    if (element.pathname === window.location.pathname.split("/").slice(0, 3).join("/")) {
        element.classList.add("active");
    }
});

let back_to_top_button = document.querySelector(".back-to-top");
document.addEventListener("scroll", () => {
    if (window.scrollY < 10)
        back_to_top_button.classList.add('d-none');
    else
        back_to_top_button.classList.remove('d-none');
});

let numberInputs = document.querySelectorAll(".input-baht input");
numberInputs.forEach((numberInput) => {
    numberInput.addEventListener("input", (event) => {
        let originalValue = event.target.value;
        const originalSelectionStart = event.target.selectionStart;
        const originalSelectionEnd = event.target.selectionEnd;

        let newValue = originalValue
            .replace(/[^\d.]/g, "")
            .replace(/^\./g, "")
            .replace(/\.{2,}/g, ".")
            .replace(/^0+(\d)/, "$1")
            .replace(/^(\d*\.\d{0,2})\d*$/, "$1")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if (newValue === "0") {
            newValue = "";
        }

        const dotsCount = (newValue.match(/\./g) || []).length;
        if (dotsCount > 1) {
            event.target.value = event.target.oldValue;
        } else if (newValue !== originalValue) {
            event.target.value = newValue;
            event.target.selectionStart = originalSelectionStart + (event.target.value.length - originalValue.length);
            event.target.selectionEnd = originalSelectionEnd + (event.target.value.length - originalValue.length);
        }
        event.target.oldValue = event.target.value;
    });
});