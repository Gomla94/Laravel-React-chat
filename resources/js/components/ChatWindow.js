import React, { useEffect, useState } from "react";
import chat from "../src/chat";

import ChatWrapper from "./ChatWrapper";

const ChatWindow = () => {
    const [showChatWrapper, setShowChatWrapper] = useState(false);
    const [showAlertMessages, setShowAlertMessages] = useState(true);
    const [users, setUsers] = useState([]);
    const [clicked, setClicked] = useState({ value: false });

    useEffect(() => {
        const userNavbarcomments = document.querySelector(
            ".navbar-user-comment"
        );
        userNavbarcomments.addEventListener("click", changeClicked);
        userNavbarcomments.addEventListener("click", checkChatWrapper);
        const mainDiv = document.querySelector(".main");
        mainDiv.addEventListener("click", () => {
            setShowChatWrapper(false);
        });

        const envelopes = document.querySelectorAll(".user-green-message-box");
        envelopes.forEach((item) => {
            item.addEventListener("click", (e) => {
                e.stopPropagation();
                fetchTopUser(item.dataset.nid);
                checkChatWrapper();
            });
        });
    }, []);

    const fetchTopUser = (userId) => {
        setClicked({ ...clicked, value: true });
        chat.get("/top-chat-user", {
            params: { nid: userId },
        }).then((response) => {
            setUsers(response.data);
        });
    };

    const checkChatWrapper = () => {
        setShowChatWrapper((prevStatus) => !prevStatus);
    };

    const changeClicked = () => {
        setUsers([]);
        setClicked({ ...clicked, value: false });
    };

    return (
        <div className="chat">
            <i
                className="far fa-comments navbar-user-comment"
                onClick={() => {
                    setShowAlertMessages(!showAlertMessages);
                }}
            ></i>

            {showChatWrapper ? (
                <ChatWrapper
                    showAlertMessages={showAlertMessages}
                    fetchedUsers={users}
                    clicked={clicked}
                />
            ) : (
                ""
            )}
        </div>
    );
};

export default ChatWindow;
