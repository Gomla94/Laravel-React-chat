import React, { useEffect, useState, useRef, Fragment } from "react";
import chat from "../src/chat";
const ChatWindow = () => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const [chattingWithUser, setChattingWithUser] = useState(null);
    const [blockedUserId, setBlockedUserId] = useState(null);
    const authId = window.Laravel.user.id;
    const [spinner, setSpinner] = useState(null);
    const [userIsAlreadyBlocked, setUserIsAlreadyBlocked] = useState(null);
    const [blockMessage, setBlockMessage] = useState(null);
    const scrollToEndRef = useRef(null);

    const envelopes = document.querySelectorAll(".user-envelope");
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
            console.log("aaa");
            console.log(
                document
                    .querySelector(".chat-users-list")
                    .children[0].classList.add("current-active-user")
            );
        } else {
            const parentElement = e.target.closest(".active-user");
            parentElement.classList.toggle("current-active-user");
        }

        setToUserId(userId);
    };

    useEffect(() => {
        fetchAllMessagesWithUser(toUserId);
    }, [toUserId]);

    const onKeyUp = (e) => {
        if (e.code === "Enter") {
            sendMessage();
        }
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
        document.querySelector(".messages-section-middle").scrollTop =
            document.querySelector(".messages-section-middle").scrollHeight;
    }, [messages]);

    useEffect(() => {
        window.Echo.private(`messages.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                // console.log(prevMessages.current);
                prevMessages.current.push(event.message);
                // console.log(prevMessages.current);
                setMessages([...prevMessages.current]);
            }
        );
    }, []);

    useEffect(() => {
        console.log("envelope");
        console.log(envelopes);
        envelopes.forEach((item) => {
            item.addEventListener("click", (e) => {
                e.stopPropagation();
                fetchTopUser(item.dataset.id);
                document
                    .querySelector(".chat-wrapper")
                    .classList.toggle("show-chat-wrapper");
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

        // return;
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
        console.log(userId);
        chat.get("/top-chat-user", {
            params: { user_id: parseInt(userId) },
        }).then((response) => {
            setUsers(response.data);
            changeToUserId(null, userId);
            // setToUserId(userId);
        });
    };

    const fetchAllUsers = () => {
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const renderredMessages = (messages) => {
        if (messages === null) {
            return;
        }
        return messages.map((message, index) => {
            if (message.user.id === authId) {
                return (
                    <div className="sent-message-wrapper" key={index}>
                        <div className="sent-message-image-wrapper">
                            <img
                                className="chat-user-image"
                                src={
                                    message.user.image
                                        ? `../${message.user.image}`
                                        : `../images/avatar.png`
                                }
                                alt=""
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
                        <div className="received-message-image-wrapper">
                            <img
                                className="chat-user-image"
                                src={
                                    message.user.image
                                        ? `../${message.user.image}`
                                        : `../images/avatar.png`
                                }
                                alt=""
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
                        className="message message-image"
                        src={`../${message.media_path}`}
                    />
                </a>
            );
        } else if (message.type === "video") {
            return (
                <video
                    controls={true}
                    className="message message-video"
                    src={`../${message.media_path}`}
                ></video>
            );
        }
        return <p className="message">{message.message}</p>;
    };

    const renderredUsers = (users) => {
        return users.map((user) => {
            return (
                <li
                    className="active-user"
                    onClick={(e) => {
                        changeToUserId(e, user.id);
                    }}
                    key={user.id}
                >
                    <img
                        src={
                            user.image
                                ? `../${user.image}`
                                : `../images/avatar.png`
                        }
                        className="active-user-img"
                        alt=""
                    />
                    <div className="chat-user-name">{user.name}</div>
                </li>
            );
        });
    };

    const sendMessage = (e) => {
        if (newMessage === null) {
            return false;
        }
        chat.post("/messages", {
            from: authId,
            to: toUserId,
            message: newMessage,
        }).then((response) => {
            setMessages([...messages, response.data.sent_message]);
        });
        document.querySelector(".message-input").value = "";
    };

    const sendMedia = (e) => {
        let formdata = new FormData();
        const image = e.target.files[0];
        formdata.append("file", image);
        formdata.append("to", toUserId);
        formdata.append("from", authId);
        const fileSize = e.target.files[0].size / 1024 / 1024;
        if (fileSize > 2) {
            alert("maximum size is 2 MB");
            return false;
        }

        chat.post("/messages", formdata).then((response) => {
            setMessages([...messages, response.data.sent_message]);
            // console.log(response.data);
            e.target.value = "";
        });
    };

    const fetchAllMessagesWithUser = (toUserId) => {
        if (toUserId === null) {
            return false;
        }

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
                <div className="attachement-wrapper">
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

                <input
                    className="message-input"
                    disabled={toUserId ? false : true}
                    placeholder="Напишите здесь свой текст ..."
                    type="text"
                    onChange={(e) => setNewMessage(e.target.value)}
                    onKeyPress={(e) => {
                        onKeyUp(e);
                    }}
                />
                <div className="send-wrapper" onClick={sendMessage}>
                    <i className="fas fa-paper-plane chat-paper-plane"></i>
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
        <div>
            <i className="far fa-comments" onClick={fetchAllUsers}></i>
            <div className="chat-wrapper">
                <i
                    className="fas fa-caret-up"
                    style={{
                        color: "rgb(239, 235, 241)",
                        fontSize: "50px",
                        marginRight: "125px",
                    }}
                ></i>
                <div className="active-users-section">
                    <div className="active-users-top-section">
                        {/* {!spinner ? showBlockButtons() : ""} */}

                        {/* {spinner ? <div className="loader"></div> : ""} */}
                        {showBlockButtons()}
                    </div>
                    <div className="active-users">
                        <div className="active-users-search-wrapper">
                            <i className="fas fa-search active-users-search"></i>
                            <i className="fas fa-window-close chat-window-close"></i>
                            <input
                                className="active-users-input"
                                placeholder="Поиск по кантактам"
                                type="text"
                            />
                        </div>
                        <div className="active-users-list-wrapper">
                            <ul className="chat-left-section">
                                <div className="chat-users-list">
                                    {renderredUsers(users)}
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div className="messages-section">
                    <div className="messages-section-top">
                        <div className="chatting-with-user">
                            {chattingWithUser}
                        </div>
                        <div className="chatting-user-status">
                            <div className="chatting-user-status-icon"></div>
                            <div className="chat-status-text">online</div>
                        </div>
                    </div>
                    <div className="messages-section-middle">
                        <div className="scroll" ref={scrollToEndRef}>
                            {renderredMessages(messages)}
                        </div>
                    </div>
                    <div className="messages-section-bottom">
                        <div className="chat-inputs-container">
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
