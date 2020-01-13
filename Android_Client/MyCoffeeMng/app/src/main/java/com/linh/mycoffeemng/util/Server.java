package com.linh.mycoffeemng.util;

import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.data.ConnectServer;

import static com.linh.mycoffeemng.activity.DangnhapActivity.ip;

public class Server {

    public static String URL_SERVER = "http://192.168.43.101:8080/CoffeeManagement/WebServer/public/";
//    public static final String URL_SERVER = "https://admin-nlcn.herokuapp.com/";

    public static final String USER_NAME = "ten_dang_nhap";
    public static final String PASSWORD = "mat_khau";
    public static final String TOKEN = "token";

    public static API getAPI() {
        return ConnectServer.getClient(URL_SERVER +"api/").create(API.class);
    }
}
