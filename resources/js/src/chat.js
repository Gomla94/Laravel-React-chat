import axios from "axios";

export default axios.create({
    baseURL: "http://www.magaxat.com/api/",
    headers: {
        "Access-Control-Allow-Origin": "*",
        authorization: `Bearer ${
            window.Laravel ? window.Laravel.user.api_token : null
        }`,
    },
});
