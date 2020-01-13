package com.linh.mycoffeemng.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Ban {
    @SerializedName("ma_ban")
    @Expose
    private Integer maban;
    @SerializedName("trang_thai")
    @Expose
    private String trangthai;
    @SerializedName("ten_ban")
    @Expose
    private String tenban;
//    private boolean duocchon;

    public Ban(int maban, String tenban, String trangthai) {
        this.maban = maban;
        this.tenban = tenban;
        this.trangthai = trangthai;
    }

//    public boolean isDuocchon() {
//        return duocchon;
//    }
//
//    public void setDuocchon(boolean duocchon) {
//        this.duocchon = duocchon;
//    }

    public Integer getMaban() {
        return maban;
    }

    public void setMaban(Integer maban) {
        this.maban = maban;
    }

    public String getTenban() {
        return tenban;
    }

    public void setTenban(String tenban) {
        this.tenban = tenban;
    }

    public String getTrangthai() {
        return trangthai;
    }

    public void setTrangthai(String trangthai) {
        this.trangthai = trangthai;
    }
}
