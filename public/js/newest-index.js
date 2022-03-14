const menuBars = document.querySelector(".menu-bars");
const overlay = document.querySelector(".overlay");
const languagesIcon = document.querySelector(".languages-icon");
const languagesList = document.querySelector(".languages-list");
const userNavbarArrow = document.querySelector(".user-navbar-arrow");
const userAddsList = document.querySelector(".user-adds-list");

// modal buttons
const postsBtn = document.querySelector(".main-posts-add-post-button");
const appealsBtn = document.querySelector(".main-posts-add-appeal-button");
const postsModalWrapper = document.querySelector(".posts-modal-wrapper");
const appealsModalWrapper = document.querySelector(".appeals-modal-wrapper");
const postsModalContnt = document.querySelector(".posts-modal-content");
const appealsModalContnt = document.querySelector(".appeals-modal-content");
const closePostsModal = document.querySelector(".close-posts-modal");
const closeAppealsModal = document.querySelector(".close-appeals-modal");

const usersFilterIcon = document.querySelector(".users-filter-icon");
const usersFilterSelects = document.querySelector(".users-filter-selects");

if (usersFilterIcon) {
    usersFilterIcon.addEventListener("click", () => {
        usersFilterSelects.classList.toggle("sh-users-filter-selects");
    });
}

const showPostsModal = () => {
    postsModalWrapper.style.display = "block";
    postsModalContnt.classList.add("show-posts-modal-content");
};

const closePostsModalHandler = () => {
    postsModalWrapper.style.display = "none";
    postsModalContnt.classList.remove("show-posts-modal-content");
};

const closeAppealsModalHandler = () => {
    appealsModalWrapper.style.display = "none";
    appealsModalContnt.classList.remove("show-posts-modal-content");
};

const showAppealsModal = () => {
    appealsModalWrapper.style.display = "block";
    appealsModalContnt.classList.add("show-posts-modal-content");
};

if (postsBtn) {
    postsBtn.addEventListener("click", showPostsModal);
}

if (appealsBtn) {
    appealsBtn.addEventListener("click", showAppealsModal);
}

if (closePostsModal) {
    closePostsModal.addEventListener("click", closePostsModalHandler);
}

if (closeAppealsModal) {
    closeAppealsModal.addEventListener("click", closeAppealsModalHandler);
}

if (menuBars) {
    menuBars.addEventListener("click", toggleOverlay);
}

function toggleOverlay() {
    overlay.classList.toggle("show-overlay");
}

function showLanguagesList() {
    languagesList.classList.toggle("show-languages-list");
}

if (languagesIcon) {
    languagesIcon.addEventListener("click", showLanguagesList);
}

if (userNavbarArrow) {
    userNavbarArrow.addEventListener("click", showUserAddsList);
}

function showUserAddsList() {
    userAddsList.classList.toggle("show-user-adds-list");
}