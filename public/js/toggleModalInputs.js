const modalChecker = document.querySelector(".modal-checker");
const modalImageInputContainer = document.querySelector(
    ".modal-image-container"
);

const modalCheckerContainer = document.querySelector(
    ".modal-checker-container"
);

const removeImageInput = () => {
    document.querySelector(".modal-image-container").remove();
};

const removeVideoInput = () => {
    document.querySelector(".modal-video-container").remove();
};

const addmodalVideoInput = () => {
    const videoInput = `
    <div class="form-group modal-video-container">
              <label class="create-post-label" for="video">Video</label>
              <input type="file" class="form-control" name="video">
          </div>
    
    `;

    modalCheckerContainer.insertAdjacentHTML("afterend", videoInput);
};

const addModalImageInput = () => {
    const imageInput = `
    <div class="form-group modal-image-container">
              <label class="create-post-label" for="image">Image</label>
              <input type="file" class="form-control" name="image">
          </div>
    
    `;

    modalCheckerContainer.insertAdjacentHTML("afterend", imageInput);
};

const changeModalInputs = (e) => {
    e.target.classList.toggle("change-modal-checker");
    if (document.querySelector(".modal-image-container")) {
        removeImageInput();
        addmodalVideoInput();
    } else {
        removeVideoInput();
        addModalImageInput();
    }
};

if (modalChecker) {
    modalChecker.addEventListener("click", changeModalInputs);
}
