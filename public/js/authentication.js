// const { default: axios } = require("axios");

const typesList = document.querySelector(".types-list");
const interestingsList = document.querySelector(".interestings-list");
const registerForm = document.querySelector(".register-form");
const interestingListLabel = document.querySelector(".interesting-lists-label");

typesList.addEventListener("change", (e) => {
    let selectedValue = e.target.value;
    if (selectedValue === "ordinary_user") {
        fetchAllInterstingTypes();
    } else {
        interestingsList.classList.remove("show-interestings-list");
        document.querySelector(".interestings-list-ddl").remove();
    }
});

const insertAfter = (referenceNode, newNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
};

const createSelectInput = (interestingTypes = null) => {
    const selectInput = document.createElement("select");
    selectInput.classList.add("form-input");
    selectInput.classList.add("interestings-list-ddl");
    selectInput.setAttribute("name", "interesting_type");
    interestingTypes.forEach((type) => {
        const option = document.createElement("option");
        option.value = type.id;
        option.textContent = type.name;
        selectInput.appendChild(option);
    });
    insertAfter(interestingListLabel, selectInput);
    document
        .querySelector(".interestings-list-group-div")
        .classList.add("show-interestings-list");
};

const fetchAllInterstingTypes = () => {
    axios
        .get("/interesting-types")
        .then((response) => createSelectInput(response.data));
};
