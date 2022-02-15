import React, { useEffect, useState } from "react";
import chat from "../src/chat";

import ChatWrapper from "./ChatWrapper";

const ChatWindow = () => {
    const [showChatWrapper, setShowChatWrapper] = useState(false);
    const [showAlertMessages, setShowAlertMessages] = useState(true);
    const [users, setUsers] = useState([]);

    useEffect(() => {
        const userNavbarcomments = document.querySelector(
            ".navbar-user-comment"
        );
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
        chat.get("/top-chat-user", {
            params: { nid: userId },
        }).then((response) => {
            setUsers(response.data);
        });
    };

    const checkChatWrapper = () => {
        setShowChatWrapper((prevStatus) => !prevStatus);
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
                />
            ) : (
                ""
            )}
        </div>
    );
};

export default ChatWindow;
