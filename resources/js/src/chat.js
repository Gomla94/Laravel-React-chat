import axios from "axios";

export default axios.create({
    // baseURL: "https://seriousapp.test/api/",
    baseURL: "https://www.magaxat.com/api/",
    headers: {
        "Access-Control-Allow-Origin": "*",
        "X-CSRF-TOKEN": window.Laravel.csrfToken,
        authorization: `Bearer ${
            window.Laravel ? window.Laravel.user.api_token : null
        }`,
    },
});
