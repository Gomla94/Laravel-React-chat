import axios from "axios";
import React, { useEffect, useState } from "react";
import notify from "../src/notify";

const Notifications = ({
    showNotifications,
    notifications,
    setNotifications,
}) => {
    // const [loadedNotifications = setLoadedNotifications] = useState(null);

    useEffect(() => {
        renderNotifications(notifications);
    }, [notifications]);

    const checkNotification = async (e) => {
        const filteredNotifications = notifications.filter(
            (item) => item.id !== e.target.dataset.nid
        );

        const response = await notify.post("/check-notification", {
            nid: e.target.dataset.nid,
            status: e.target.classList.contains("accept-notify")
                ? "accept"
                : "decline",
        });

        if (response.error) {
            return false;
        }

        setNotifications(filteredNotifications);
    };

    const renderNotifications = (myNotifications) => {
        if (myNotifications == null) {
            return;
        }

        return myNotifications.map((item) => {
            return (
                <div className="notification" key={item.id}>
                    <div className="notification-title">New Subscribtion</div>
                    <div className="notification-info">
                        <div className="notification-user-image">
                            <img
                                src={
                                    item.data.user_image ??
                                    `../../images/avatar.png`
                                }
                            />
                        </div>
                        <p>
                            <span className="notification-main">
                                {item.data.user_name}
                            </span>{" "}
                            subscribed to you, subscribe back to be able to chat
                            with him.
                        </p>
                    </div>
                    <div className="notification-actions-wrapper">
                        <i
                            className="fas fa-check-square accept-notify"
                            data-nid={item.id}
                            onClick={(e) => {
                                checkNotification(e);
                            }}
                        ></i>
                        <i
                            className="fas fa-window-close deny-notify"
                            data-nid={item.id}
                            onClick={(e) => {
                                checkNotification(e);
                            }}
                        ></i>
                    </div>
                </div>
            );
        });
    };

    return (
        <div className="notifications-wrapper">
            <div className="notifications-container">
                {renderNotifications(notifications)}
            </div>
        </div>
    );
};

export default Notifications;
