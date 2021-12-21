import axios from "axios";

export default axios.create({
    baseURL: "http://www.magaxat.com/api/",
    headers: {
        "Access-Control-Allow-Origin": "*",
        authentication: `Bearer ${window.Laravel.csrfToken}`,
    },
});
