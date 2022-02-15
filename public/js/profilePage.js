const profileListItems = document.querySelectorAll(".profile-item");
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
document.getElementById("dt").max = maxDate;
