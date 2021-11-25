import React, { useEffect, useState, useRef } from "react";
import chat from "../src/chat";
// import "../../../public/css/index.css";
const ChatWindow = () => {
    console.log("authId");

    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState(null);
    const [toUserId, setToUserId] = useState(null);
    const authId = window.Laravel.user.id;

    const scrollToEndRef = useRef(null);

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
                    // setMessages([...messages, event.message]);
                } else {
                    setMessages([...messages, event.message]);
                }
            }
        );
    }, []);

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
            console.log(messages);
            console.log(response.data.message);
        });
    };

    const fetchAllMessagesWithUser = async (toUserId) => {
        setToUserId(toUserId);
        chat.get(
            `/messages?from=${window.Laravel.user.id}&to=${toUserId}`
        ).then((response) => {
            setMessages(response.data);
        });
    };
    return (
        <div>
            <i className="far fa-comments" onClick={fetchAllUsers}></i>
            <div className="chat-wrapper">
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
                                {/* <div className="chat-settings">
                                    <li className="active-user">
                                        <div
                                            className="bell-icon-wrapper"
                                            alt=""
                                        ></div>
                                        <i className="fas fa-bell"></i>
                                        <div className="chat-user-name">
                                            Техподдержка
                                        </div>
                                    </li>
                                    <li className="active-user">
                                        <div
                                            className="bell-icon-wrapper"
                                            alt=""
                                        ></div>
                                        <i className="fas fa-cog"></i>
                                        <div className="chat-user-name">
                                            Техподдержка
                                        </div>
                                    </li>
                                    <li className="active-user">
                                        <div
                                            className="bell-icon-wrapper"
                                            alt=""
                                        ></div>
                                        <i className="fas fa-cog"></i>
                                        <div className="chat-user-name">
                                            Техподдержка
                                        </div>
                                    </li>
                                </div> */}
                                <div className="chat-users-list">
                                    {renderredUsers(users)}
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div className="messages-section">
                    <div className="messages-section-top">
                        <div class="chatting-with-user">Ahmed</div>
                        <div class="chatting-user-status">
                            <div class="chatting-user-status-icon"></div>
                            <div class="chat-status-text">online</div>
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
