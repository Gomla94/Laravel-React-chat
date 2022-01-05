const menuBars = document.getElementById("menu-bars");
const overlay = document.querySelector(".overlay");
const userNavbarArrow = document.querySelector(".user-navbar-arrow-down");
const userNavbarList = document.querySelector(".user-navbar-list");
const navbarChatIcon = document.querySelector(".navbar-user-comment");
const chatWrapper = document.querySelector(".chat-wrapper");
const chatArrow = document.querySelector(".chat-arrow");

const postsBtn = document.querySelector(".main-posts-add-post-button");
const appealsBtn = document.querySelector(".main-posts-add-appeal-button");
const postsModalWrapper = document.querySelector(".posts-modal-wrapper");
const appealsModalWrapper = document.querySelector(".appeals-modal-wrapper");
const closePostsModal = document.querySelector(".close-posts-modal");
const closeAppealsModal = document.querySelector(".close-appeals-modal");

// const addCommentBtn = document.querySelectorAll(".post-comment-btn");
// const commentIcon = document.querySelectorAll(".main-post-comments-icon");

const filterUsersIcon = document.querySelector(".filter-users-wrapper");
const filtersList = document.querySelector(".filters-list");
const filterItems = document.querySelectorAll(".filter-item");
const subFilterLists = document.querySelectorAll(".sub-filters-list");
const filterArrows = document.querySelectorAll(".filter-item-arrow");

const userGreenButton = document.querySelector(".one-user-green-button");
const userAdditionalInfo = document.querySelector(".user-additional-info");

const logoutAnchor = document.querySelector(".logout");
const logoutForm = document.querySelector(".logout-form");

const profileImageInput = document.querySelector(".profile-image-input");

const mainDiv = document.querySelector(".main");

if (chatWrapper) {
    mainDiv.addEventListener("click", () => {
        chatWrapper.classList.remove("show-chat-wrapper");
        document
            .querySelector(".chat-arrow")
            .classList.remove("show-chat-arrow");
    });
}

// if (profileImageInput) {
//     profileImageInput.addEventListener("change", () => {
//         const profileImage = document.querySelector(".profile-image");
//         profileImage.src = URL.createObjectURL(profileImageInput.files[0]);
//         console.log("clicked");
//     });
// }

if (logoutAnchor) {
    logoutAnchor.addEventListener("click", () => {
        logoutForm.submit();
    });
}

const showPostsModal = () => {
    postsModalWrapper.style.display = "block";
};

const showAppealsModal = () => {
    appealsModalWrapper.style.display = "block";
};

if (postsBtn) {
    postsBtn.onclick = () => {
        showPostsModal();
    };
}

if (appealsBtn) {
    appealsBtn.onclick = function () {
        showAppealsModal();
    };
}

if (closePostsModal) {
    closePostsModal.onclick = function () {
        postsModalWrapper.style.display = "none";
    };
}

if (closeAppealsModal) {
    closeAppealsModal.onclick = function () {
        appealsModalWrapper.style.display = "none";
    };
}

if (userGreenButton) {
    userGreenButton.addEventListener("click", () => {
        userAdditionalInfo.classList.toggle("show-additional-info");
    });
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

if (navbarChatIcon) {
    navbarChatIcon.addEventListener("click", () => {
        chatWrapper.classList.toggle("show-chat-wrapper");
        chatArrow.classList.toggle("show-chat-arrow");
    });
}

// if (commentIcon) {
//     commentIcon.forEach((icon) => {
//         icon.addEventListener("click", showCommentSection);
//     });
// }

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
}

if (userNavbarArrow) {
    userNavbarArrow.addEventListener("click", () => {
        userNavbarList.classList.toggle("show-user-navbar-list");
    });
}

// async function showCommentSection(e) {
//     const clickedCommentIcon = e.target;
//     const commentsSection =
//         clickedCommentIcon.closest(".main-post-socials").nextElementSibling;

//     commentsSection.classList.toggle("show-main-post-comments-section");
//     const shownCommentsSection = commentsSection.querySelectorAll(".comment");

//     // if (shownCommentsSection.length > 0) {
//     //   commentsSection.classList.toggle("show-post-comments-container");

//     //   shownCommentsSection.forEach((section) => {
//     //     section.remove();
//     //   });
//     //   return false;
//     // }

//     // const comments = await fetchAllComments(clickedCommentIcon.id);
//     // if (comments.length === 0) {
//     //   return false;
//     // }

//     // comments.forEach((comment) => {
//     //   const commentDiv = `<div id="comment" class="comment">
//     //     <div class="comment-date">
//     //     <span class="comment-user-name">${comment.user.name}</span>
//     //     <span class="comment-date">${new Date(
//     //       comment.created_at
//     //     ).toDateString()}</span>
//     //     </div>
//     //     <p class="comment-body">${comment.title}</p>
//     //   </div>
//     //     `;
//     //   clickedCommentIcon.closest(".post-social").nextElementSibling.innerHTML +=
//     //     commentDiv;
//     // });

//     // commentsSection.classList.toggle("show-post-comments-container");
// }
