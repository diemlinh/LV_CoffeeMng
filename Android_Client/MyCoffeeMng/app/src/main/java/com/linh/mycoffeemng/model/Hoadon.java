package com.linh.mycoffeemng.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.sql.Timestamp;

public class Hoadon {
    @SerializedName("ma_hoa_don")
    @Expose
    private Integer mahoadon;
    @SerializedName("ma_ban")
    @Expose
    private Integer maban;
    @SerializedName("ngay_lap")
    @Expose
    private String ngaylap;
    @SerializedName("trang_thai")
    @Expose
    private String trangthai;
    @SerializedName("tong_tien")
    @Expose
    private Integer tongtien;
    @SerializedName("ngay_sua")
    @Expose
    private String ngaysua;
    @SerializedName("nv_lap")
    @Expose
    private String nvlap;

    public Hoadon(Integer mahoadon, Integer maban, String ngaylap, String trangthai, Integer tongtien, String ngaysua, String nvlap) {
        this.mahoadon = mahoadon;
        this.maban = maban;
        this.ngaylap = ngaylap;
        this.trangthai = trangthai;
        this.tongtien = tongtien;
        this.ngaysua = ngaysua;
        this.nvlap = nvlap;
    }

    public Hoadon() {

    }

    public Integer getMahoadon() {
        return mahoadon;
    }

    public void setMahoadon(Integer mahoadon) {
        this.mahoadon = mahoadon;
    }

    public Integer getMaban() {
        return maban;
    }

    public void setMaban(Integer maban) {
        this.maban = maban;
    }

    public String getNgaylap() {
        return ngaylap;
    }

    public void setNgaylap(String ngaylap) {
        this.ngaylap = ngaylap;
    }

    public String getTrangthai() {
        return trangthai;
    }

    public void setTrangthai(String trangthai) {
        this.trangthai = trangthai;
    }

    public Integer getTongtien() {
        return tongtien;
    }

    public void setTongtien(Integer tongtien) {
        this.tongtien = tongtien;
    }

    public String getNgaysua() {
        return ngaysua;
    }

    public void setNgaysua(String ngaysua) {
        this.ngaysua = ngaysua;
    }

    public String getNvlap() {
        return nvlap;
    }

    public void setNvlap(String nvlap) {
        this.nvlap = nvlap;
    }
}
