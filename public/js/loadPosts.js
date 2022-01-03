import { addComment } from "../js/addPostComment.js";
import { fetchAllComments } from "../js/addPostComment.js";
import { likePostClickHandler } from "../js/addPostLike.js";

const postsWrapper = document.querySelector(".posts-wrapper");
let currentPostsIds = [];
const postDivs = document.querySelectorAll(".main-post");
postDivs.forEach((item) => {
    currentPostsIds.push(parseInt(item.dataset.id));
});

const fetchPosts = async () => {
    console.log(currentPostsIds);
    const posts = await axios.get("/loadposts", {
        params: {
            ids: currentPostsIds,
        },
    });

    posts.data.forEach((post) => {
        currentPostsIds.push(post.id);
    });

    return posts.data;
};

const loadPosts = async () => {
    if (
        window.scrollY + document.body.offsetHeight >=
        document.body.scrollHeight
    ) {
        const loadedPosts = await fetchPosts();
        loadedPosts.forEach((post) => {
            postsWrapper.innerHTML += createPost(post);
        });
        document
            .querySelectorAll(".main-post-comments-icon")
            .forEach((item) => {
                item.addEventListener("click", showPostCommentSection);
            });

        document
            .querySelectorAll(".main-post-comment-button")
            .forEach((item) => {
                item.addEventListener("click", addComment);
            });

        document.querySelectorAll(".post-heart-icon").forEach((item) => {
            item.addEventListener("click", likePostClickHandler);
        });
    }
};

const createPost = (post) => {
    return `
            <div class="main-post" data-id=${post.id}>
            <div class="main-post-user-info-wrapper">
            ${appendUserImage(post)}
            <div class="main-post-user-names-wrapper">
                <span class="main-post-user-name">${post.user.name}</span>
                <span class="main-post-user-email">@${post.user.name}</span>
            </div>
            <span class="post-date">${new Date(post.created_at)
                .toLocaleString()
                .replace(",", "")}</span>
            </div>
            <p class="main-post-title">${post.title}</p>
            ${post.description ? appendPostDescription(post) : ""}
            ${post.image ? appendPostImage(post) : ""}
            ${post.video ? appendPostVideo(post) : ""}
            <div class="main-post-comment-form-wrapper">
            <form class="main-post-comment-form">
                <div class="form-group">
                <textarea
                    name="title"
                    class="form-control main-post-form-textarea"
                    id="${post.id}"
                    cols="30"
                    rows="10"
                ></textarea>
                </div>
                <div class="comment-error-div">
                    <span class="comment-error-span"></span>
                </div>
                <button type="button" class="main-post-comment-button">
                Add Comment
                </button>
            </form>
            </div>
            <div class="main-post-socials">
            <div class="main-post-likes">
                <span>${post.likes ? post.likes.length : 0}</span>
                <i id=${post.id} class="fas fa-heart main-post-heart-icon ${
        window.Laravel.user ? "post-heart-icon" : ""
    }
    ${checkIfAuthUserLikedPost(post) ? "liked-post-heart-icon" : ""}"></i>
            </div>
            <div class="main-post-comments">
                <span class="comments-count-span">${
                    post.comments ? post.comments.length : 0
                }</span>
                <i class="far fa-comments main-post-comments-icon" id=${
                    post.id
                }></i>
            </div>
            </div>
            <div class="main-post-comments-section"></div>
        </div>
    `;
};
window.addEventListener("scroll", loadPosts);

function appendUserImage(post) {
    return `
        <div class="main-post-user-image-wrapper">
            <img
            src="/${
                post.user.image ? `${post.user.image}` : "images/avatar.png"
            }"
            alt="user-image"
            class="main-post-user-image"
            />
        </div>
    `;
}

function appendPostDescription(post) {
    return ` 
        <p class="main-post-description">
        ${post.description.substring(0, 500)}
        </p>    
    `;
}

function appendPostImage(post) {
    return `
        <div class="main-post-image-wrapper">
        <img src="${post.image}" alt="post-image" class="main-post-image" />
        </div>
    `;
}

function appendPostVideo(post) {
    return `
        <div class="main-post-video-wrapper">
        <video
            controls
            src="${post.video}"
            alt="video"
            class="main-post-video"
        ></video>
        </div>
    `;
}

const showPostCommentSection = async (e) => {
    const clickedCommentIcon = e.target;
    const addCommentSection =
        clickedCommentIcon.closest(".main-post-socials").previousElementSibling;

    addCommentSection.classList.toggle("show-main-post-comment-form-wrapper");

    const commentsSection =
        clickedCommentIcon.closest(".main-post-socials").nextElementSibling;

    commentsSection.classList.toggle("show-add-comment-section");

    const shownCommentsSection = commentsSection.querySelectorAll(".comment");

    if (shownCommentsSection.length > 0) {
        commentsSection.classList.toggle("show-main-post-comments-section");

        shownCommentsSection.forEach((section) => {
            section.remove();
        });
        return false;
    }

    const comments = await fetchAllComments(clickedCommentIcon.id);
    if (comments.length === 0) {
        return false;
    }

    comments.forEach((comment) => {
        const commentDiv = `<div id="comment" class="comment">
        <div class="comment-date">
        <span class="comment-user-name">${comment.user.name}</span>
        <span class="comment-date">${new Date(
            comment.created_at
        ).toDateString()}</span>
        </div>
        <p class="comment-body">${comment.title}</p>
      </div>
        `;
        clickedCommentIcon.closest(
            ".main-post-socials"
        ).nextElementSibling.innerHTML += commentDiv;
    });

    commentsSection.classList.toggle("show-main-post-comments-section");
};

function checkIfAuthUserLikedPost(post) {
    let liked = false;
    console.log(post.likes);
    post.likes.forEach((item) => {
        item.user_id === window.Laravel.user.id ? (liked = true) : null;
    });

    return liked;
}
