import React, { useEffect, useState, useRef, Fragment } from "react";
import chat from "../src/chat";
import InputEmoji from "react-input-emoji";
import notify from "../src/notify";

const ChatWrapper = (props) => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const [chattingWithUser, setChattingWithUser] = useState(null);
    const [chattingUserImage, setchattingUserImage] = useState(null);
    const authId = window.atob(window.uuxyz.uuxyzq);
    const [spinner, setSpinner] = useState(null);
    const [userIsAlreadyBlocked, setUserIsAlreadyBlocked] = useState(null);
    const [blockMessage, setBlockMessage] = useState(null);
    const scrollToEndRef = useRef(null);

    const userBlocker = document.querySelector(".sound-checker");
    const userBlockerBackground = document.querySelector(
        ".sound-checker-background"
    );

    useEffect(() => {
        setUsers(props.fetchedUsers);
    }, [props.fetchedUsers]);

    useEffect(() => {
        window.Echo.leave(`messages.${props.toUserId}.${authId}`);

        fetchAllMessagesWithUser(props.toUserId);
    }, [props.toUserId]);

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

        window.Echo.leave(`messages.${props.toUserId}.${authId}`);

        setToUserId(userId);
    };

    const onKeyUp = (e) => {
        if (props.toUserId === null) {
            return false;
        }

        if (e.keyCode === 13) {
            sendMessage();
        }
    };

    useEffect(() => {
        prevMessages.current = messages;
    });

    const prevMessages = useRef([]);

    useEffect(() => {
        document.querySelector(".chat-messages-section").scrollTop =
            document.querySelector(".chat-messages-section").scrollHeight;
    }, [messages]);

    useEffect(() => {
        removeAlertMessagesWrapper();
    }, [props.showAlertMessages]);

    const removeAlertMessagesWrapper = () => {
        const alertMessages = document.querySelector(".alert-message-wrapper");
        if (alertMessages) {
            alertMessages.remove();
        }
    };

    const fetchAllUsers = () => {
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
                        <p className="sent-message-date">
                            {new Date(message.created_at).toLocaleString(
                                "en-US",
                                {
                                    hour: "numeric",
                                    minute: "numeric",
                                    hour12: true,
                                }
                            )}
                        </p>
                        <div className="sent-message">
                            {renderMessageType(message)}
                        </div>
                    </div>
                );
            } else {
                return (
                    <div className="received-message-wrapper" key={index}>
                        <p className="received-message-date">
                            {new Date(message.created_at).toLocaleString(
                                "en-US",
                                {
                                    hour: "numeric",
                                    minute: "numeric",
                                    hour12: true,
                                }
                            )}
                        </p>
                        <div className="received-message">
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
                        src={`${message.media_path}`}
                    />
                </a>
            );
        } else if (message.type === "video") {
            return (
                <video
                    controls={true}
                    className="message-video"
                    src={`${message.media_path}`}
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
                                user.image !== null
                                    ? `${user.image}`
                                    : `../../images/avatar.png`
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

    const sendMessage = (e) => {
        if (newMessage === null || newMessage === "") {
            return false;
        }
        const chatInput = document.querySelector(".chat-input");
        chatInput.value = "";
        chat.post("/messages", {
            to: props.toUserId,
            message: newMessage,
        }).then((response) => {
            setNewMessage(null);
            setMessages([...messages, response.data.sent_message]);
        });
    };

    const sendMedia = (e) => {
        if (props.toUserId == null) {
            return false;
        }
        let formdata = new FormData();
        const image = e.target.files[0];
        formdata.append("file", image);
        formdata.append("to", props.toUserId);
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

        window.Echo.private(`messages.${props.toUserId}.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                prevMessages.current.push(event.message);
                setMessages([...prevMessages.current]);
            }
        );

        chat.get(
            `/messages?from=${window.btoa(authId)}&to=${window.btoa(toUserId)}`
        ).then((response) => {
            if (response.data.messages.length === 0) {
                setMessages(response.data.messages);
                prevMessages.current = [];
            } else {
                setMessages(response.data.messages);
                prevMessages.current = [];
            }

            setChattingWithUser(response.data.chatting_with_user.name);
            setchattingUserImage(response.data.chatting_with_user.image);
        });
    };

    const renderChattingWithUserImage = () => {
        if (chattingWithUser) {
            if (chattingUserImage) {
                return <img src={chattingUserImage} alt="person" />;
            } else {
                return <img src="../../images/avatar.png" alt="person" />;
            }
        }
    };

    return (
        <Fragment>
            <div className="active-chat-wrapper">
                <div className="chatting-with-user">
                    <div className="chatting-with-user-image-wrapper">
                        <i
                            className="fa-solid fa-chevron-left chat-back-icon"
                            onClick={() => {
                                props.setViewChatWrapper(false);
                            }}
                        ></i>
                        {renderChattingWithUserImage()}
                    </div>
                    <div className="chatting-with-user-name">
                        <p>{chattingWithUser}</p>
                    </div>
                </div>
                <div className="chat-messages-section">
                    {renderredMessages(messages)}
                </div>
                <div className="chat-input-wrapper">
                    <div className="chat-attachement-wrapper">
                        <label className="chat-media-input">
                            <i className="fa-solid fa-link">
                                <input
                                    type="file"
                                    className="attachement-input"
                                    accept="image/*,video/*"
                                    onChange={(e) => {
                                        sendMedia(e);
                                    }}
                                />
                            </i>
                        </label>
                    </div>
                    <input
                        type="text"
                        onKeyUp={(e) => {
                            onKeyUp(e);
                        }}
                        className="chat-input"
                        onChange={(e) => {
                            setNewMessage(e.target.value);
                        }}
                    />
                </div>
            </div>
            <div className="chat-send-wrapper">
                <div className="chat-send-button" onClick={sendMessage}>
                    <img src={"../../images/send.png"} alt="send" />
                </div>
            </div>
        </Fragment>
    );
};

export default ChatWrapper;
