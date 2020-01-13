package com.linh.mycoffeemng.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Sanpham {
    @SerializedName("ma_sp")
    @Expose
    private Integer masp;
    @SerializedName("ten_sp")
    @Expose
    private String tensp;
    @SerializedName("ma_loai")
    @Expose
    private Integer maloai;
    @SerializedName("don_gia")
    @Expose
    private Integer dongia;
    @SerializedName("trang_thai")
    @Expose
    private String trang_thai;
    @SerializedName("hinh_anh")
    @Expose
    private String hinhanh;

    public Sanpham(Integer masp, String tensp, Integer maloai, Integer dongia, String trang_thai, String hinhanh) {
        this.masp = masp;
        this.tensp = tensp;
        this.maloai = maloai;
        this.dongia = dongia;
        this.trang_thai = trang_thai;
        this.hinhanh = hinhanh;
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

    public Integer getMaloai() {
        return maloai;
    }

    public void setMaloai(Integer maloai) {
        this.maloai = maloai;
    }

    public Integer getDongia() {
        return dongia;
    }

    public void setDongia(Integer dongia) {
        this.dongia = dongia;
    }

    public String getTrang_thai() {
        return trang_thai;
    }

    public void setTrang_thai(String trang_thai) {
        this.trang_thai = trang_thai;
    }

    public String getHinhanh() {
        return hinhanh;
    }

    public void setHinhanh(String hinhanh) {
        this.hinhanh = hinhanh;
    }
}
