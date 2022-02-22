import React, { useEffect, useState } from "react";
import chat from "../src/chat";
import notify from "../src/notify";

import ChatWrapper from "./ChatWrapper";

const ChatWindow = () => {
    const authId = window.atob(window.uuxyz.uuxyzq);
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

    useEffect(() => {
        // fetchAllUsers();
    }, []);

    useEffect(() => {
        const bellIcon = document.querySelector(".bell-icon");
        if (bellIcon) {
            bellIcon.addEventListener("click", () => {
                setTimeout(() => {
                    const acceptNotification =
                        document.querySelectorAll(".accept-notify");

                    acceptNotification.forEach((item) => {
                        item.addEventListener("click", () => {
                            notificationUser(item.dataset.nid);
                        });
                    });
                }, 500);
            });
        }

        window.Echo.private(`messages.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                checkChatWrapperStatusBeforeAlertingNewMessageCount(
                    users,
                    event.message.user
                );
            }
        );
    }, [users]);

    const fetchTopUser = (userId) => {
        setClicked({ ...clicked, value: true });
        chat.get("/top-chat-user", {
            params: { nid: userId },
        }).then((response) => {
            setUsers(response.data);
        });
    };

    const notificationUser = async (nid) => {
        const response = await notify.get("/notification-user", {
            params: { nid: nid },
        });
        setUsers([...users, response.data]);
    };

    const checkChatWrapper = () => {
        setShowChatWrapper((prevStatus) => !prevStatus);
    };

    const changeClicked = () => {
        setUsers([]);
        setClicked({ ...clicked, value: false });
    };

    const fetchAllUsers = () => {
        if (users.length !== 0) return;
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const checkChatWrapperStatusBeforeAlertingNewMessageCount = (
        subscribers,
        userToCheck
    ) => {
        const targetUser = subscribers.findIndex(
            (user) => userToCheck.id === user.id
        );

        if (targetUser === -1) {
            return false;
        } else {
            createAlertMessage();
        }
    };

    const createAlertMessage = () => {
        if (document.querySelector(".chat-wrapper") !== null) return false;

        const messagesCount = document.querySelector(".messages-count");
        if (!messagesCount) {
            const chat = document.querySelector(".chat");
            const alertMessageWrapper = document.createElement("div");
            alertMessageWrapper.classList.add("alert-message-wrapper");
            const alertMessage = document.createElement("div");
            alertMessage.classList.add("alert-new-message");
            const messageCountSpan = document.createElement("span");
            messageCountSpan.classList.add("messages-count");
            messageCountSpan.textContent = 1;
            alertMessageWrapper.appendChild(alertMessage);
            alertMessageWrapper.appendChild(messageCountSpan);
            chat.prepend(alertMessageWrapper);
        } else {
            messagesCount.textContent = parseInt(messagesCount.textContent) + 1;
        }
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
