package com.linh.mycoffeemng.data;
import android.content.Context;

import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Chitiethoadon;
import com.linh.mycoffeemng.model.Giohang;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.model.Loaisanpham;
import com.linh.mycoffeemng.model.Login;
import com.linh.mycoffeemng.model.Message;
import com.linh.mycoffeemng.model.Sanpham;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface API {

    @FormUrlEncoded
    @POST("auth/login")
    Call<Login> dangnhap(@Field("ten_dang_nhap") String ten_dang_nhap,
                          @Field("mat_khau") String mat_khau);
//    String token = Server.TOKEN;

    @GET("ban")
    Call<List<Ban>> getBan (@Query("token") String token);
    @GET("loai")
    Call<List<Loaisanpham>> getLoai (@Query("token") String token);
    @GET("sanpham")
    Call<List<Sanpham>> getSanpham (@Query("token") String token);
    @GET("hoadon/{id}")
    Call<Hoadon> getHoadon (@Path("id") Integer id,
                            @Query("token") String token);
    @GET("chitiethoadon/{id}")
    Call<List<Chitiethoadon>> getChitiet (@Path("id") Integer id,
                                          @Query("token") String token);
    @GET("goimon/{id}/{maban}/{ghichu}")
    Call<List<Chitiethoadon>> Goimon (@Path("id") Integer id,
                                      @Path("maban") Integer maban,
                                      @Path("ghichu") String ghichu,
                                      @Query("token") String token);
    @FormUrlEncoded
    @POST("goimon/{id}")
    Call<String> goimon (@Path("id") Integer id,
                         @Field("tong_tien") Integer tong_tien,
                         @Query("token") String token);
    @FormUrlEncoded
    @POST("themmon/{ma_ban}")
    Call<Giohang> postGiohang (
                              @Path("ma_ban") Integer ma_ban,
                              @Field("ma_sp") Integer ma_sp,
                              @Field("so_luong") Integer so_luong,
                              @Field("ghi_chu") String ghi_chu,
                              @Query("token") String token);
    @FormUrlEncoded
    @POST("capnhatSL/{id}")
    Call<String> capnhat (
            @Path("id") Integer id,
            @Field("so_luong") Integer so_luong,
            @Query("token") String token);
    @FormUrlEncoded
    @POST("capnhat/{id}")
    Call<String> suaGiohang (
            @Path("id") Integer id,
//            @Field("so_luong") Integer so_luong,
            @Field("ghi_chu") String ghi_chu,
            @Query("token") String token);
    @GET("xoagiohang/{id}")
    Call<String> Xoagh (@Path("id") Integer id,
                         @Query("token") String token);
    @PUT("datrong/{id}")
    Call<String> trongBan (@Path("id") Integer id,
                        @Query("token") String token);
    @FormUrlEncoded
    @POST("thanhtoan")
    Call<Hoadon> thanhtoan (
            @Field("ma_ban") Integer ma_ban,
            @Query("token") String token);
    @GET("getSolgPhacheTrongHD/{hoadonId}/{sanphamId}")
    Call<String> getSolgPhacheTrongHD (@Path("hoadonId") Integer hoadonId,
                                       @Path("sanphamId") Integer sanphamId,
                                       @Query("token") String token);
    @GET("getUserInfo")
    Call<Object> getUserInfo (@Query("token") String token);
}
