const typesList = document.querySelector(".types-list");
const interestingsList = document.querySelector(".interesting-types");
const registerForm = document.querySelector(".register-form");
const interestingListLabel = document.querySelector(".interesting-types-label");
const childTypesLabel = document.querySelector(".child-types-label");
const childTypesSelect = document.querySelector(".child-types-select");
const organisationDescriptionLabel = document.querySelector(
    ".organisation-label"
);
const organisationDescriptionInput = document.querySelector(
    ".organisation-input"
);
const showPasswordIcon = document.querySelector(".show-password-icon");

if (showPasswordIcon) {
    showPasswordIcon.addEventListener("click", () => {
        const passwordInput = showPasswordIcon.previousElementSibling;
        if (passwordInput.type == "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
}

if (childTypesSelect) {
    childTypesSelect.addEventListener("change", (e) => {
        if (e.target.value === "organisation") {
            organisationDescriptionLabel.classList.remove("organisation-label");
            organisationDescriptionInput.classList.remove("organisation-input");
        } else {
            organisationDescriptionLabel.classList.add("organisation-label");
            organisationDescriptionInput.classList.add("organisation-input");
        }
    });
}

if (typesList) {
    typesList.addEventListener("change", (e) => {
        let selectedValue = e.target.value;
        if (selectedValue === "ordinary_user") {
            fetchAllInterstingTypes();
            interestingListLabel.classList.remove("show-element");
            childTypesLabel.classList.remove("child-types-label");
            childTypesSelect.classList.remove("child-types-select");

            // organisationDescriptionDiv.
        } else {
            // interestingsList.classList.remove("show-interesting-types");
            childTypesLabel.classList.add("child-types-label");
            childTypesSelect.classList.add("child-types-select");
            organisationDescriptionLabel.classList.add("organisation-label");
            organisationDescriptionInput.classList.add("organisation-input");
            interestingListLabel.classList.remove("show-interesting-types");
            document.querySelector(".interestings-list-ddl").remove();
        }
    });
}

const insertAfter = (referenceNode, newNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
};

const createSelectInput = (interestingTypes = null) => {
    const selectInput = document.createElement("select");
    selectInput.classList.add("form-input");
    selectInput.classList.add("interestings-list-ddl");
    selectInput.setAttribute("name", "interesting_type");
    selectInput.addEventListener("change", onChildTypeChange);
    interestingTypes.forEach((type) => {
        const option = document.createElement("option");
        option.value = type.id;
        option.textContent = type.name;
        selectInput.appendChild(option);
    });
    insertAfter(interestingListLabel, selectInput);
    document
        .querySelector(".interesting-types-group-div")
        .classList.add("show-interesting-types");
};

const fetchAllInterstingTypes = () => {
    axios.get("/interesting-types").then((response) => {
        if (response.data.length === 0) {
            return false;
        }
        createSelectInput(response.data);
    });
};

const onChildTypeChange = (e) => {
    console.log(e.target);
};
