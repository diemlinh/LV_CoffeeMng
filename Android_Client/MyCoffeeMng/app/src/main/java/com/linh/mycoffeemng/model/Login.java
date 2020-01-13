package com.linh.mycoffeemng.model;
import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;
public class Login {
    @SerializedName("token")
    @Expose
    private String TOKEN;

    public String getTOKEN() {
        return TOKEN;
    }

    public void setTOKEN(String TOKEN) {
        this.TOKEN = TOKEN;
    }
}
