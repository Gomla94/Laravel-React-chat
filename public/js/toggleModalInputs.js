const modalChecker = document.querySelector(".modal-checker");
const modalImageInputContainer = document.querySelector(
    ".modal-image-container"
);

const modalCheckerContainer = document.querySelector(
    ".modal-checker-container"
);

const removeImageInput = () => {
    document.querySelector(".post-modal-image-container").remove();
};

const removeVideoInput = () => {
    document.querySelector(".post-modal-video-container").remove();
};

const addmodalVideoInput = () => {
    const videoInput = `
    <div class="form-group post-modal-video-container">
              <label class="create-post-label" for="video">Video</label>
              <input type="file" accept="video/*" class="form-control" name="post_video">
          </div>
    
    `;

    modalCheckerContainer.insertAdjacentHTML("afterend", videoInput);
};

const addModalImageInput = () => {
    const imageInput = `
    <div class="form-group post-modal-image-container">
              <label class="create-post-label" for="image">Image</label>
              <input type="file" accept="image/*" class="form-control" name="post_image">
          </div>
    
    `;

    modalCheckerContainer.insertAdjacentHTML("afterend", imageInput);
};

const changeModalInputs = (e) => {
    e.target.classList.toggle("change-modal-checker");
    const imageContainer = document.querySelector(
        ".post-modal-image-container"
    );
    console.log(imageContainer);
    if (imageContainer) {
        console.log("image");
        removeImageInput();
        addmodalVideoInput();
    } else {
        console.log("video");

        removeVideoInput();
        addModalImageInput();
    }
};

if (modalChecker) {
    modalChecker.addEventListener("click", changeModalInputs);
}
