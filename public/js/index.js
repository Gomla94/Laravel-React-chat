const menuBars = document.getElementById("menu-bars");
const overlay = document.querySelector(".overlay");
const filterIcon = document.querySelector(".rs-filter");
const userPageFilterIcon = document.querySelector(
    ".user-page-filter-icon-filter"
);
const searchListWrapper = document.querySelector(".search-list-wrapper");
const commentLogo = document.querySelector(".fa-comments");
const chatWrapper = document.querySelector(".chat-wrapper");
const body = document.getElementsByTagName("body");
const userPageGreenButton = document.querySelector(".user-page-green-button");
const userAdditionalInfo = document.querySelector(".user-additional-info");
const filterItems = document.querySelectorAll(".filter-item");
const subFilterLists = document.querySelectorAll(".sub-filters-list");
const filterUsersIcon = document.querySelector(".filter-users-container");
const filtersList = document.querySelector(".filters-list");
const filterArrows = document.querySelectorAll(".filter-item-arrow");

const modalWrapper = document.querySelector(".modal-wrapper");
const postsBtn = document.querySelector(".posts-button");
const closeModal = document.querySelector(".close-modal");

if (postsBtn) {
    postsBtn.onclick = function () {
        modalWrapper.style.display = "block";
    };
}

if (closeModal) {
    closeModal.onclick = function () {
        modalWrapper.style.display = "none";
    };
}

if (filterUsersIcon) {
    filterUsersIcon.addEventListener("click", () => {
        subFilterLists.forEach((list) => {
            list.style.display = "none";
        });
        filtersList.classList.toggle("show-filters-list");

        filterArrows.forEach((arrow) => {
            arrow.classList.remove("active-filter-arrow");
        });
    });
}

const filterItemClickHandler = (e) => {
    subFilterLists.forEach((list) => {
        list.style.display = "none";
    });

    filterArrows.forEach((arrow) => {
        arrow.classList.remove("active-filter-arrow");
    });

    const clickedItemList = e.target
        .closest(".filter-item")
        .querySelector(".sub-filters-list");

    const filterArrow = e.target
        .closest(".filter-item")
        .querySelector(".filter-item-arrow");
    filterArrow.classList.toggle("active-filter-arrow");

    if (clickedItemList.style.display == "none") {
        clickedItemList.style.display = "block";
    } else {
        clickedItemList.style.display = "none";
    }
};

if (filterItems) {
    filterItems.forEach((item) => {
        item.addEventListener("click", filterItemClickHandler);
    });
}

if (userPageGreenButton) {
    userPageGreenButton.addEventListener("click", () => {
        userAdditionalInfo.classList.toggle("show-additional-info");
    });
}
if (commentLogo) {
    commentLogo.addEventListener("click", () => {
        chatWrapper.classList.toggle("show-chat-wrapper");
    });
}

if (filterIcon) {
    filterIcon.addEventListener("click", () => {
        searchListWrapper.classList.toggle("show-search-list-wrapper");
    });
}

menuBars.addEventListener("click", toggleMenu);
function toggleMenu() {
    menuBars.classList.toggle("menu-active");
    if (menuBars.classList.contains("menu-active")) {
        overlay.classList.add("menu-slide-right");
        overlay.classList.remove("menu-slide-left");
    } else {
        overlay.classList.remove("menu-slide-right");
        overlay.classList.add("menu-slide-left");
    }
    // menuBars.classList.toggle("change");
    // menuBars.classList.toggle("menu-active");
}
