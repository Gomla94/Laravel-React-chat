$(".profile-image-input").on("change", function () {
    $(".left-side").css("margin-top", "80px");
    $(".profile-image").remove();
    $image_crop = $(".image-demo").croppie({
        enableExif: true,
        viewport: {
            height: 200,
            width: 200,
            type: "circle",
        },
        boundary: {
            height: 300,
            width: 300,
        },
    });
    var reader = new FileReader();
    reader.onload = function (event) {
        $image_crop.croppie("bind", {
            url: event.target.result,
        });
    };
    reader.readAsDataURL(this.files[0]);
});

$(".update-profile-button").on("click", function (event) {
    if ($(".profile-image-input").val()) {
        event.preventDefault();
        $image_crop
            .croppie("result", {
                type: "canvas",
                size: "viewport",
            })
            .then(function (response) {
                axios
                    .put("/update-profile-image", {
                        croppedImage: response,
                    })
                    .then((response) => {
                        $(".profile-form").submit();
                    });
            });
    }
});
