import React, { useEffect, useState } from "react";
import Notifications from "./Notifications";
import notify from "../src/notify";

const NewSubscribtionNotification = () => {
    const authId = window.Laravel.user.id;
    const [showNotifications, setShowNotifications] = useState(false);
    const [notifications, setNotifications] = useState(null);
    const navbarChatIcon = document.querySelector(".navbar-user-comment");

    const removeChatWrapper = () => {
        const chatWrapper = document.querySelector(".chat-wrapper");
        const chatArrow = document.querySelector(".chat-arrow");
        chatWrapper.classList.remove("show-chat-wrapper");
        chatArrow.classList.remove("show-chat-arrow");
    };

    useEffect(() => {
        const mainDiv = document.querySelector(".main");
        mainDiv.addEventListener("click", () => {
            setShowNotifications(false);
        });

        navbarChatIcon.addEventListener("click", () => {
            setShowNotifications(false);
        });
    }, []);

    useEffect(() => {
        if (notifications !== null) {
            return false;
        }
        loadNotifications();
    }, [showNotifications]);

    useEffect(() => {
        if (notifications !== null) {
            window.Echo.leave(`user_notifications.${authId}`);

            window.Echo.private(`user_notifications.${authId}`).notification(
                (notification) => {
                    setNotifications([...notifications, notification]);
                }
            );
        }
    });

    const renderNotificationsCount = () => {
        if (notifications === null || notifications.length === 0) {
            return "";
        }

        return <span className="count">{notifications.length}</span>;
    };

    const loadNotifications = async () => {
        const response = await notify.get("my_notifications");
        const loadedNotifications = response.data;
        setNotifications(loadedNotifications);
    };

    return (
        <div>
            <i
                className="fas fa-bell bell-icon"
                onClick={() => {
                    removeChatWrapper();
                    setShowNotifications(!showNotifications);
                }}
            >
                {renderNotificationsCount()}
            </i>
            {showNotifications ? (
                <Notifications
                    notifications={notifications}
                    setNotifications={setNotifications}
                    showNotifications={showNotifications}
                />
            ) : (
                ""
            )}
        </div>
    );
};

export default NewSubscribtionNotification;
