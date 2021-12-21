import axios from "axios";

export default axios.create({
    baseURL: "http://www.magaxat.com",
    headers: {
        "Access-Control-Allow-Origin": "*",
    },
});
