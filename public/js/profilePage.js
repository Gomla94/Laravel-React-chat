const profileListItems = document.querySelectorAll(".profile-item");
const additionalTypeInput = document.getElementById("additional_type");
const organisationDescription = document.querySelector(".org-d");

const additionalTypeHandler = () => {
    if (
        additionalTypeInput.options[additionalTypeInput.selectedIndex].value ==
        "organisation"
    ) {
        organisationDescription.classList.remove("d-none");
        organisationDescription.classList.add("d-block");
    } else {
        organisationDescription.classList.remove("d-block");
        organisationDescription.classList.add("d-none");
    }
};
additionalTypeInput.addEventListener("change", (e) => {
    additionalTypeHandler(e);
});

profileListItems.forEach((item) => {
    item.addEventListener("click", (e) => {
        removeActiveItem();
        e.target.classList.add("active");
    });
});

const removeActiveItem = () => {
    const activeItems = document.querySelectorAll(".active");
    activeItems.forEach((item) => {
        item.classList.remove("active");
    });
};

const tabBtn = document.querySelectorAll(".nav ul li");
const tab = document.querySelectorAll(".tab");

function tabs(panelIndex) {
    tab.forEach(function (node) {
        node.style.display = "none";
    });
    tab[panelIndex].style.display = "block";
}
tabs(0);

const today = new Date();
const eighteenYearsAgo = today.setFullYear(today.getFullYear() - 18);
const maxDate = new Date(eighteenYearsAgo).toISOString().split("T")[0];
const dateInput = document.getElementById("dt");
if (dateInput) {
    dateInput.max = maxDate;
}
