import React, { useEffect, useState } from "react";
import Notifications from "./Notifications";
import notify from "../src/notify";

const NewSubscribtionNotification = () => {
    const authId = window.Laravel.user.id;
    const [showNotifications, setShowNotifications] = useState(false);
    const [notifications, setNotifications] = useState(null);

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

    const loadNotifications = async () => {
        const response = await notify.get("/my_notifications");
        const loadedNotifications = response.data;
        setNotifications(loadedNotifications);
        // return renderNotifications(loadedNotifications);
    };

    return (
        <div>
            <i
                className="fas fa-bell bell-icon"
                onClick={() => {
                    setShowNotifications(!showNotifications);
                }}
            >
                <span className="count">
                    {notifications !== null ? notifications.length : ""}
                </span>
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
