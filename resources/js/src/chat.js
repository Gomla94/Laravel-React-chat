import axios from "axios";

export default axios.create({
    baseURL: "http://www.magaxat.com/api/",
    headers: {
        "Access-Control-Allow-Origin": "*",
        authorization: `Bearer ${window.laravel.user.api_token}`,
    },
});
