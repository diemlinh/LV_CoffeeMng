package com.linh.mycoffeemng.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Loaisanpham {
    @SerializedName("ma_loai")
    @Expose
    public Integer maloai;
    @SerializedName("ten_loai")
    @Expose
    public String tenloai;

    public Loaisanpham(Integer maloai, String tenloai) {
        this.maloai = maloai;
        this.tenloai = tenloai;
    }

    public Integer getMaloai() {
        return maloai;
    }

    public void setMaloai(Integer maloai) {
        this.maloai = maloai;
    }

    public String getTenloai() {
        return tenloai;
    }

    public void setTenloai(String tenloai) {
        this.tenloai = tenloai;
    }
}
