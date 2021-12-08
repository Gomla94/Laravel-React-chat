import axios from "axios";
import React, { useEffect, useState, useRef } from "react";
import chat from "../src/chat";
// import "../../../public/css/index.css";
const ChatWindow = () => {
    console.log("authId");

    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const [chattingWithUser, setChattingWithUser] = useState("");
    const authId = window.Laravel.user.id;

    const scrollToEndRef = useRef(null);

    const envelopes = document.querySelectorAll(".user-envelope");

    useEffect(() => {
        document.querySelector(".messages-section-middle").scrollTop =
            document.querySelector(".messages-section-middle").scrollHeight;
    }, [messages]);

    useEffect(() => {
        window.Echo.private(`messages.${authId}`).listen(
            "NewMessageEvent",
            (event) => {
                if (messages.length === 0) {
                    fetchAllMessagesWithUser(event.message.user.id);
                } else {
                    setMessages([...messages, event.message]);
                }
            }
        );

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

    const fetchTopUser = (userId) => {
        console.log(userId);
        chat.get("/top-chat-user", {
            params: { user_id: parseInt(userId) },
        }).then((response) => {
            setUsers(response.data);
            fetchAllMessagesWithUser(userId);
        });
    };

    const fetchAllUsers = () => {
        chat.get("/chat-users").then((response) => {
            setUsers(response.data);
        });
    };

    const renderredMessages = (messages) => {
        return messages.map((message, index) => {
            if (message.user.id === authId) {
                return (
                    <div className="sent-message-wrapper" key={index}>
                        <div className="sent-message-image-wrapper">
                            <img
                                className="chat-user-image"
                                src={message.user.image}
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
                                src={message.user.image}
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
                <img
                    className="message message-image"
                    src={`../../../${message.media_path}`}
                />
            );
        } else if (message.type === "video") {
            return (
                <video
                    controls={true}
                    className="message message-video"
                    src={`../../../${message.media_path}`}
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
                    onClick={() => {
                        fetchAllMessagesWithUser(user.id);
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

    const sendMessage = () => {
        if (newMessage === null) {
            return false;
        }
        document.querySelector(".message-input").value = "";

        chat.post("/messages", {
            from: authId,
            to: toUserId,
            message: newMessage,
        }).then((response) => {
            setMessages([...messages, response.data.message]);
        });
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
            setMessages([...messages, response.data.message]);
            e.target.value = "";
        });
    };

    const fetchAllMessagesWithUser = async (toUserId) => {
        setToUserId(toUserId);
        chat.get(
            `/messages?from=${window.Laravel.user.id}&to=${toUserId}`
        ).then((response) => {
            setMessages(response.data.messages);
            setChattingWithUser(response.data.chatting_with_user.name);
            // fetchAllUsers();
            // console.log(response.data);
        });
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
                            />
                            {/* <div className="video-wrapper">
                            <i className="fas fa-photo-video"></i>
                        </div>
                        <div className="image-wrapper">
                            <i className="fas fa-images"></i>
                        </div> */}
                            <div className="send-wrapper" onClick={sendMessage}>
                                <i className="fas fa-paper-plane chat-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChatWindow;
