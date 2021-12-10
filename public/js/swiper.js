const slider = document.querySelector(".appeals-wrapper");
const innerSlider = document.querySelector(".inner-appeals-wrapper");

let pressed = false;
let x = 0;
let startX = 0;

slider.addEventListener("mouseenter", () => {
    slider.style.cursor = "grab";
});

slider.addEventListener("mousedown", (e) => {
    slider.style.cursor = "grabbing";
    pressed = true;
    startX = e.offsetX - innerSlider.offsetLeft;
});

window.addEventListener("mouseup", () => {
    pressed = false;
});

slider.addEventListener("mouseup", () => {
    slider.style.cursor = "grab";
});

slider.addEventListener("mousemove", (e) => {
    if (!pressed) return;
    e.preventDefault();
    console.log("moving");
    pressed = true;
    x = e.offsetX;
    innerSlider.style.left = `${x - startX}px`;
    checkBoundaries();
});

function checkBoundaries() {
    const outer = slider.getBoundingClientRect();
    const inner = innerSlider.getBoundingClientRect();

    if (parseInt(innerSlider.style.left) > 0) {
        innerSlider.style.left = "0px";
    } else if (inner.right < outer.right) {
        innerSlider.style.left = `-${inner.width - outer.width}px`;
    }
}
