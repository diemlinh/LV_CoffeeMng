package com.linh.mycoffeemng.util;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.content.Context;
import android.media.Image;
import android.os.Build;
import android.support.v4.app.NotificationCompat;
import android.support.v4.app.NotificationManagerCompat;

import com.linh.mycoffeemng.R;

public class NotificationUtil {
    public static final int NOTIFICATION_ID = 888;

    public static void sendNotification(Context context, int icon, String titleText, String contentText) {
        String notificationChannelId = createNotificationChannel(context);
        NotificationCompat.Builder builder = new NotificationCompat.Builder(context, notificationChannelId)
                .setSmallIcon(icon)
                .setContentTitle(titleText)
                .setContentText(contentText)
                .setPriority(NotificationCompat.PRIORITY_DEFAULT);
        NotificationManagerCompat notificationManager = NotificationManagerCompat.from(context);
        notificationManager.notify(NOTIFICATION_ID, builder.build());
    }

    public static String createNotificationChannel(Context context) {
        // Create the NotificationChannel, but only on API 26+ because
        // the NotificationChannel class is new and not in the support library
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            String channelId = "phache-notification";
            CharSequence name = "phache notification";
            String description = "phache notification description";
            int importance = NotificationManager.IMPORTANCE_DEFAULT;
            NotificationChannel channel = new NotificationChannel(channelId, name, importance);
            channel.setDescription(description);
            // Register the channel with the system; you can't change the importance
            // or other notification behaviors after this
            NotificationManager notificationManager = context.getSystemService(NotificationManager.class);
            notificationManager.createNotificationChannel(channel);

            return channelId;
        } else {
            return null;
        }
    }
}
