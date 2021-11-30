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
            item.addEventListener("click", () => {
                // fetchAllMessagesWithUser(item.dataset.id);
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
                            <p className="message">{message.message}</p>
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
                            <p className="message">{message.message}</p>
                        </div>
                    </div>
                );
            }
        });
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
                    <img src={user.image} className="active-user-img" alt="" />
                    <div className="chat-user-name">{user.name}</div>
                </li>
            );
        });
    };

    const sendMessage = () => {
        if (newMessage === null) {
            return false;
        }
        chat.post("/messages", {
            from: authId,
            to: toUserId,
            message: newMessage,
        }).then((response) => {
            setMessages([...messages, response.data.message]);
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
                    <div className="active-users-top-section">
                        <div className="sound-check-background"></div>
                        <div className="sound-checker"></div>
                        <span className="check-sound">Звук</span>
                    </div>
                    <div className="active-users">
                        <div className="active-users-search-wrapper">
                            <i className="fas fa-search active-users-search"></i>
                            <i className="fas fa-window-close"></i>
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
                                <i className="fas fa-paperclip"></i>
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
                                <i className="fas fa-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChatWindow;
