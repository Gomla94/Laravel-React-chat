import React, { useEffect, useState, useRef, Fragment } from "react";
import chat from "../src/chat";
import InputEmoji from "react-input-emoji";

const ChatWindow = () => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const [chattingWithUser, setChattingWithUser] = useState(null);
    const [blockedUserId, setBlockedUserId] = useState(null);
    const authId = window.Laravel.user.unique_id;
    const [spinner, setSpinner] = useState(null);
    const [userIsAlreadyBlocked, setUserIsAlreadyBlocked] = useState(null);
    const [blockMessage, setBlockMessage] = useState(null);
    const scrollToEndRef = useRef(null);
    const [showAlertMessages, setShowAlertMessages] = useState(true);

    const envelopes = document.querySelectorAll(".user-green-message-box");
    const userBlocker = document.querySelector(".sound-checker");
    const userBlockerBackground = document.querySelector(
        ".sound-checker-background"
    );

    const changeToUserId = (e, userId) => {
        const activeUsersClass = document.querySelectorAll(
            ".current-active-user"
        );
        activeUsersClass.forEach((item) =>
            item.classList.remove("current-active-user")
        );

        if (e === null) {
            const chatUsersList = document.querySelector(".chat-users-list");
            chatUsersList.children[0].classList.toggle("current-active-user");
        } else {
            const parentElement = e.target.closest(".chat-user-wrapper");
            parentElement
                .querySelector(".user-new-message-alert")
                .classList.remove("show-user-new-message-alert");
            parentElement.classList.toggle("current-active-user");
        }

        window.Echo.leave(`messages.${toUserId}.${authId}`);

        setToUserId(userId);
    };

    useEffect(() => {
        fetchAllMessagesWithUser(toUserId);
    }, [toUserId]);

    const onKeyUp = (e) => {
        if (toUserId === null) {
            return false;
        }
        sendMessage();
    };

    useEffect(() => {
        if (spinner === null) {
            return false;
        }
        showBlockButtons();
    }, [spinner]);

    useEffect(() => {
        if (userIsAlreadyBlocked === null) {
            return;
        }
        if (userIsAlreadyBlocked) {
            addBlockedUserStyle();
        } else {
            removeBlockedUserStyle();
        }
    }, [userIsAlreadyBlocked]);

    useEffect(() => {
        prevMessages.current = messages;
    });

    const prevMessages = useRef([]);

    useEffect(() => {
        document.querySelector(".messages-middle-section").scrollTop =
            document.querySelector(".messages-middle-section").scrollHeight;
    }, [messages]);

    const createAlertMessage = () => {
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

    const checkForTargetChatUserElement = (targetChatUser) => {
        if (targetChatUser) {
            targetChatUser
                .querySelector(".user-new-message-alert")
                .classList.add("show-user-new-message-alert");
        }
    };

    useEffect(() => {
        if (users.length > 0) {
            window.Echo.leave(`messages.${authId}`);

            window.Echo.private(`messages.${authId}`).listen(
                "NewMessageEvent",
                (event) => {
                    checkChatWrapperStatusBeforeAlertingNewMessageCount(
                        users,
                        event.message.user
                    );

                    if (toUserId === event.message.user.unique_id) return false;

                    const targetChatUser = document.getElementById(
                        event.message.user.unique_id
                    );
                    checkForTargetChatUserElement(targetChatUser);

                    return false;
                }
            );
        }
    }, [users, toUserId]);

    const checkifMessageUserIsInMySubscribtion = (
        checkSubscriber,
        subscribers
    ) => {
        const targetUser = subscribers.findIndex(
            (item) => checkSubscriber.id === item.id
        );

        if (targetUser === -1) {
            return false;
        }

        return true;
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
        }

        // return true;
        if (
            document
                .querySelector(".chat-wrapper")
                .classList.contains("show-chat-wrapper") === false
        ) {
            createAlertMessage();
        } else {
            return false;
        }
    };

    const listenToNewMessageAndAlertCount = () => {
        removeAlertMessagesWrapper();

        window.Echo.private(`messages.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                checkChatWrapperStatusBeforeAlertingNewMessageCount();
            }
        );
    };

    const removeAlertMessagesWrapper = () => {
        const alertMessages = document.querySelector(".alert-message-wrapper");
        if (alertMessages) {
            alertMessages.remove();
        }
    };

    useEffect(() => {
        removeAlertMessagesWrapper();
    }, [showAlertMessages]);

    useEffect(() => {
        fetchAllUsers();
        envelopes.forEach((item) => {
            item.addEventListener("click", (e) => {
                e.stopPropagation();
                fetchTopUser(item.dataset.nid);
                document
                    .querySelector(".chat-wrapper")
                    .classList.toggle("show-chat-wrapper");

                document
                    .querySelector(".chat-arrow")
                    .classList.toggle("show-chat-arrow");
            });
        });
    }, []);

    useEffect(() => {
        if (toUserId === null) {
            return false;
        }
        window.Echo.private(`blocked-user-channel.${authId}`).listen(
            "BlockUserEvent",
            (event) => {
                if (
                    authId === event.blockedUser.user_id &&
                    toUserId === event.blockedUser.blocker_id
                ) {
                    // setUserIsAlreadyBlocked(true);
                    setBlockMessage(`You have been blocked by this user!`);
                }
            }
        );

        window.Echo.private(`unblocked-user-channel.${authId}`).listen(
            "UnblockUserEvent",
            (event) => {
                if (event.if_i_still_blocked_the_user) {
                    setBlockMessage(
                        "You cannot send messages to a user you blocked!"
                    );
                } else {
                    setBlockMessage(null);
                }
                setUserIsAlreadyBlocked(null);
            }
        );
    }, [toUserId]);

    const blockUserStyle = async () => {
        if (!chattingWithUser) {
            return;
        }

        if (toUserId === blockedUserId) {
            setBlockedUserId(null);
            setUserIsAlreadyBlocked(false);
            setSpinner(true);

            const unBlockResponse = await chat.post("/unblock-user/", {
                unblockedUser: blockedUserId,
            });
            setTimeout(() => {
                setSpinner(null);
            }, 3000);

            if (unBlockResponse.data.stillBlocked) {
                setBlockMessage(`You were blocked by this user!`);
            } else {
                setBlockMessage("");
            }
        } else {
            setBlockedUserId(toUserId);
            setUserIsAlreadyBlocked(true);
            setSpinner(true);
            setBlockMessage(`You cannot send messages to a user you blocked!`);

            await chat.post("/block-user/", {
                blockedUser: toUserId,
            });

            setTimeout(() => {
                setSpinner(false);
            }, 5000);
            // setSpinner(false);
        }
    };

    const removeBlockedUserStyle = () => {
        if (userBlockerBackground && userBlockerBackground) {
            userBlockerBackground.classList.remove(
                "change-sound-checker-background"
            );
            userBlocker.classList.remove("change-sound-checker");
        }
    };

    const addBlockedUserStyle = () => {
        userBlockerBackground.classList.add("change-sound-checker-background");
        userBlocker.classList.add("change-sound-checker");
    };

    const showBlockButtons = () => {
        if (spinner) {
            return <div className="loader"></div>;
        } else if (spinner === null) {
            return (
                <Fragment>
                    <div className="sound-checker-background"></div>
                    <div
                        className="sound-checker"
                        onClick={(e) => {
                            blockUserStyle(e);
                        }}
                    ></div>

                    <span className="check-sound">блок</span>
                </Fragment>
            );
        } else if (spinner === false && blockMessage !== "") {
            return (
                <Fragment>
                    <div className="sound-checker-background change-sound-checker-background"></div>
                    <div
                        className="sound-checker change-sound-checker"
                        onClick={(e) => {
                            blockUserStyle(e);
                        }}
                    ></div>

                    <span className="check-sound">Звук</span>
                </Fragment>
            );
        }
    };

    window.Echo.private(`unblocked-user-channel.${authId}`).listen(
        "UnblockUserEvent",
        (event) => {
            setUserIsAlreadyBlocked(null);
        }
    );

    const fetchTopUser = (userId) => {
        chat.get("/top-chat-user", {
            params: { user_id: parseInt(userId) },
        }).then((response) => {
            setUsers(response.data);
            changeToUserId(null, userId);
        });
    };

    const fetchAllUsers = () => {
        // setShowAlertMessages(!showAlertMessages);
        if (users.length !== 0) return;
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const renderredMessages = (messages) => {
        if (messages === null) {
            return;
        }
        return messages.map((message, index) => {
            if (message.user.unique_id === authId) {
                return (
                    <div className="sent-message-wrapper" key={index}>
                        <div className="sent-message-user-image-wrapper">
                            <img
                                src={
                                    message.user.image
                                        ? `../${message.user.image}`
                                        : `../images/avatar.png`
                                }
                                alt="user-image"
                                className="chat-user-image"
                            />
                        </div>
                        <div className="sent-message-info">
                            {renderMessageType(message)}
                        </div>
                    </div>
                );
            } else {
                return (
                    <div className="received-message-wrapper" key={index}>
                        <div className="received-message-user-image-wrapper">
                            <img
                                src={
                                    message.user.image
                                        ? `../${message.user.image}`
                                        : `../images/avatar.png`
                                }
                                alt="user-image"
                                className="chat-user-image"
                            />
                        </div>
                        <div className="received-message-info">
                            {renderMessageType(message)}
                        </div>
                    </div>
                );
            }
        });
    };

    const renderMessageType = (message) => {
        if (message.type === "image") {
            return (
                <a download={"image"} href={message.media_path}>
                    <img
                        className="message-image"
                        src={`../${message.media_path}`}
                    />
                </a>
            );
        } else if (message.type === "video") {
            return (
                <video
                    controls={true}
                    className="message-video"
                    src={`../${message.media_path}`}
                ></video>
            );
        }
        return <p className="message">{message.message}</p>;
    };

    const renderredUsers = (users) => {
        return users.map((user) => {
            return (
                <div
                    className="chat-user-wrapper"
                    onClick={(e) => {
                        changeToUserId(e, user.unique_id);
                    }}
                    key={user.id}
                    id={user.unique_id}
                >
                    <div className="user-new-message-alert"></div>
                    <div className="chat-user-image-wrapper">
                        <img
                            src={
                                user.image
                                    ? `../${user.image}`
                                    : `../images/avatar.png`
                            }
                            className="chat-user-image"
                            alt=""
                        />
                    </div>
                    <div className="chat-user-name">{user.name}</div>
                </div>
            );
        });
    };

    const renderWelcomeMessage = () => {
        if (toUserId === null) {
            return (
                <p className="welcome-message">
                    <span>Note: </span> You need to subscribe to a user to be
                    able to chat with him, also if a user is not subscribed to
                    you he will not be able to receive your messages
                </p>
            );
        }

        return "";
    };

    const sendMessage = (e) => {
        if (newMessage === null || newMessage === "") {
            return false;
        }

        chat.post("/messages", {
            to: toUserId,
            message: newMessage,
        }).then((response) => {
            setMessages([...messages, response.data.sent_message]);
        });
    };

    const sendMedia = (e) => {
        if (toUserId == null || toUserId == "") {
            return false;
        }
        let formdata = new FormData();
        const image = e.target.files[0];
        formdata.append("file", image);
        formdata.append("to", toUserId);
        const fileSize = e.target.files[0].size / 1024 / 1024;
        if (fileSize > 2) {
            alert("maximum size is 2 MB");
            return false;
        }

        chat.post("/messages", formdata).then((response) => {
            setMessages([...messages, response.data.sent_message]);
            e.target.value = "";
        });
    };

    const fetchAllMessagesWithUser = (toUserId) => {
        if (toUserId === null) {
            return false;
        }

        window.Echo.private(`messages.${toUserId}.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                prevMessages.current.push(event.message);
                setMessages([...prevMessages.current]);
            }
        );

        chat.get(
            `/messages?from=${window.btoa(authId)}&to=${window.btoa(toUserId)}`
        ).then((response) => {
            // return;
            if (response.data.messages.length === 0) {
                setMessages(response.data.messages);
                prevMessages.current = [];
            } else {
                setMessages(response.data.messages);
                prevMessages.current = [];
            }

            setChattingWithUser(response.data.chatting_with_user.name);
            if (
                response.data.blocked_this_user &&
                response.data.blocked_by_this_user
            ) {
                setUserIsAlreadyBlocked(true);
                setBlockedUserId(toUserId);
                setBlockMessage("You both blocked each other!");
                addBlockedUserStyle();
            } else if (response.data.blocked_this_user) {
                setUserIsAlreadyBlocked(true);
                setBlockedUserId(toUserId);
                setBlockMessage(
                    "You cannot send messages to a user you blocked!"
                );
                addBlockedUserStyle();
            } else if (response.data.blocked_by_this_user) {
                setBlockMessage("You were blocked by this user!");
                removeBlockedUserStyle();
            } else {
                setBlockMessage(null);
                removeBlockedUserStyle();
            }
        });
    };

    const renderChatButtons = () => {
        return (
            <div>
                <div className="chat-attachement-wrapper">
                    <input
                        className="fas fa-paperclip chat-paperclip"
                        type="file"
                        name="file"
                        accept="image/*,video/*"
                        onChange={(e) => {
                            sendMedia(e);
                        }}
                    />
                </div>

                <InputEmoji
                    onChange={setNewMessage}
                    cleanOnEnter
                    onEnter={(e) => {
                        onKeyUp(e);
                    }}
                    placeholder="Напишите ..."
                />
                <div className="chat-send-wrapper">
                    <i
                        className="fas fa-paper-plane chat-paper-plane"
                        onClick={sendMessage}
                    ></i>
                </div>
            </div>
        );
    };

    const renderBlockedChatMessage = () => {
        return (
            <div>
                <p style={{ textAlign: "center" }}>{blockMessage}</p>
            </div>
        );
    };

    return (
        <div className="chat">
            <i
                className="far fa-comments navbar-user-comment"
                onClick={() => {
                    setShowAlertMessages(!showAlertMessages);
                }}
            ></i>
            <i className="fas fa-caret-up chat-arrow"></i>

            <div className="chat-wrapper">
                <div className="active-users-section">
                    <div className="active-users-top-section">
                        {showBlockButtons()}
                    </div>
                    <div className="active-users">
                        <div className="active-users-search-wrapper">
                            <i className="fas fa-search active-users-search"></i>
                            <i className="fas fa-window-close active-users-close"></i>
                            <input
                                className="active-users-input"
                                placeholder="Поиск"
                                type="text"
                            />
                        </div>
                        <div className="chat-users-list">
                            {renderredUsers(users)}
                        </div>
                    </div>
                </div>
                <div className="messages-section">
                    <div className="messages-top-section">
                        <div className="chatting-with-user">
                            {" "}
                            {chattingWithUser}
                        </div>
                        <div className="chatting-user-status">
                            <div className="chatting-user-status-icon"></div>
                            <div className="chat-status-text">online</div>
                        </div>
                    </div>
                    <div className="messages-middle-section">
                        <div className="scroll" ref={scrollToEndRef}>
                            {renderredMessages(messages)}
                            {renderWelcomeMessage()}
                        </div>
                    </div>
                    <div className="messages-bottom-section">
                        <div className="chat-inputs-wrapper">
                            {blockMessage
                                ? renderBlockedChatMessage()
                                : renderChatButtons()}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChatWindow;
