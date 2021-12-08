const postHeartIcon = document.querySelectorAll(".post-heart-icon");

const likePost = async (e) => {
    const heartIcon = e.target;
    const postId = heartIcon.id;
    try {
        const response = await axios.post(`posts/${postId}/add-like`, {
            postId,
        });
        if (response.data) {
            heartIcon.nextElementSibling.innerText = parseInt(
                heartIcon.nextElementSibling.innerText + 1
            );
            heartIcon.classList.toggle("liked-post-heart-icon");
        }
    } catch (error) {
        return false;
    }
};

const dislikePost = async (e) => {
    const heartIcon = e.target;
    const postId = heartIcon.id;
    try {
        const response = await axios.delete(`posts/${postId}/delete-like`, {
            postId,
        });
        if (response.data == 1) {
            heartIcon.nextElementSibling.innerText = parseInt(
                heartIcon.nextElementSibling.innerText - 1
            );
            heartIcon.classList.toggle("liked-post-heart-icon");
        }
    } catch (error) {
        return false;
    }
};

const likePostClickHandler = async (e) => {
    if (e.target.classList.contains("liked-post-heart-icon")) {
        dislikePost(e);
    } else {
        likePost(e);
    }
};

if (postHeartIcon) {
    postHeartIcon.forEach((icon) => {
        icon.addEventListener("click", likePostClickHandler);
    });
}
