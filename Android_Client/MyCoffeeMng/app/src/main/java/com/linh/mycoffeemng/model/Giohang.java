package com.linh.mycoffeemng.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Giohang {
    @SerializedName("ma_ban")
    @Expose
    private Integer maban;
    @SerializedName("ma_sp")
    @Expose
    private Integer masp;
    @SerializedName("ten_sp")
    @Expose
    private String tensp;
    @SerializedName("so_luong")
    @Expose
    private Integer soluong;
    @SerializedName("don_gia")
    @Expose
    private Integer dongia;
    @SerializedName("thanh_tien")
    @Expose
    private Integer thanhtien;
    @SerializedName("ghi_chu")
    @Expose
    private String ghichu;

    public Giohang(Integer maban, Integer masp, String tensp, Integer soluong, Integer dongia, Integer thanhtien, String ghichu) {
        this.maban = maban;
        this.masp = masp;
        this.tensp = tensp;
        this.soluong = soluong;
        this.dongia = dongia;
        this.thanhtien = thanhtien;
        this.ghichu = ghichu;
    }

    public Integer getMaban() {
        return maban;
    }

    public void setMaban(Integer maban) {
        this.maban = maban;
    }

    public Integer getMasp() {
        return masp;
    }

    public void setMasp(Integer masp) {
        this.masp = masp;
    }

    public String getTensp() {
        return tensp;
    }

    public void setTensp(String tensp) {
        this.tensp = tensp;
    }

    public Integer getSoluong() {
        return soluong;
    }

    public void setSoluong(Integer soluong) {
        this.soluong = soluong;
    }

    public Integer getDongia() {
        return dongia;
    }

    public void setDongia(Integer dongia) {
        this.dongia = dongia;
    }

    public Integer getThanhtien() {
        return thanhtien;
    }

    public void setThanhtien(Integer thanhtien) {
        this.thanhtien = thanhtien;
    }

    public String getGhichu() {
        return ghichu;
    }

    public void setGhichu(String ghichu) {
        this.ghichu = ghichu;
    }
}
