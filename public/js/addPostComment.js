const addCommentBtn = document.querySelectorAll(".post-comment-btn");
const commentIcon = document.querySelectorAll(".fa-comment");

const showCommentSection = async (e) => {
    const clickedCommentIcon = e.target;
    const commentsSection =
        clickedCommentIcon.closest(".post-social").nextElementSibling;

    const addCommentSection =
        clickedCommentIcon.closest(".post-social").previousElementSibling;

    addCommentSection.classList.toggle("show-add-comment-section");

    const shownCommentsSection = commentsSection.querySelectorAll(".comment");

    if (shownCommentsSection.length > 0) {
        commentsSection.classList.toggle("show-post-comments-container");

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
            ".post-social"
        ).nextElementSibling.innerHTML += commentDiv;
    });

    commentsSection.classList.toggle("show-post-comments-container");
};

if (commentIcon) {
    commentIcon.forEach((icon) => {
        icon.addEventListener("click", showCommentSection);
    });
}

const fetchAllComments = async (postId) => {
    const response = await axios.get(`/posts/${postId}/all-comments`);
    return response.data;
};

const addComment = async (e) => {
    e.preventDefault();
    const addCommentBtn = e.target;
    const commentInput = e.target
        .closest(".post-comment-form")
        .querySelector(".post-comment-input");

    const errorLabel = e.target.previousElementSibling;
    if (commentInput.value === "") {
        errorLabel.classList.add("show-comment-error-div");
        errorLabel.innerText = "Title Field Cannot Be Empty";
    } else {
        const response = await axios.post(
            `posts/${commentInput.id}/add-comment`,
            {
                title: commentInput.value,
            }
        );

        commentInput.value = "";
        const commentFormParent =
            addCommentBtn.closest(".post-comment-form").parentElement;
        const commentsCount =
            commentFormParent.nextElementSibling.querySelector(
                ".fa-comment"
            ).nextElementSibling;
        commentsCount.innerText = parseInt(commentsCount.innerText) + 1;
        errorLabel.classList.remove("show-comment-error-div");
    }
};

if (addCommentBtn) {
    addCommentBtn.forEach((item) => {
        item.addEventListener("click", addComment);
    });
}
