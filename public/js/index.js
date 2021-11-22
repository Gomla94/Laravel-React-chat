const menuBars = document.getElementById("menu-bars");
const overlay = document.querySelector(".overlay");
const filterIcon = document.querySelector(".fa-filter");
const searchListWrapper = document.querySelector(".search-list-wrapper");
const commentLogo = document.querySelector(".fa-comments");
const chatWrapper = document.querySelector(".chat-wrapper");

commentLogo.addEventListener("click", () => {
    chatWrapper.classList.toggle("show-chat-wrapper");
});

filterIcon.addEventListener("click", () => {
    searchListWrapper.classList.toggle("show-search-list-wrapper");
});
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
