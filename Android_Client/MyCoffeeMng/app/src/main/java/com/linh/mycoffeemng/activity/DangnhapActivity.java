package com.linh.mycoffeemng.activity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import com.google.gson.internal.LinkedTreeMap;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.data.ConnectServer;
import com.linh.mycoffeemng.model.Login;
import com.linh.mycoffeemng.model.Message;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.HttpClient;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;

import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;

public class DangnhapActivity extends AppCompatActivity {
    private AlertDialog alertDialog;
    EditText edTenDangNhapDN, edMatKhauDN, edIP;
//    CheckBox cbremember;
    Button btnDongYDN;
    ProgressDialog progressDialog;
    private Snackbar snackbar;
    private Context context;
    private API mApi;
    public static String ip = "";
    String TAG = DangnhapActivity.class.getSimpleName();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dangnhap);
        AnhXa();
        mApi = Server.getAPI();
        context = this.getApplicationContext();
        edTenDangNhapDN.setText(SharedPreferencesHandler.getString(context, Server.USER_NAME));

//        edMatKhauDN.setText(SharedPreferencesHandler.getString(context, Server.PASSWORD));
        btnDongYDN.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Dangnhap();
            }
        });
    }
    private void Dangnhap(){
        if (checkNullDangNhap()) {
            viewProgressDialog("Đang đăng nhập ... ");
            String ten_dang_nhap = edTenDangNhapDN.getText().toString().trim();
            String mat_khau = edMatKhauDN.getText().toString().trim();
            Call<Login> call = mApi.dangnhap(
                    ten_dang_nhap,
                    mat_khau);

            call.enqueue(new Callback<Login>() {
                @Override
                public void onResponse(Call<Login> call, retrofit2.Response<Login> responseLogin) {
                    final retrofit2.Response<Login> response = responseLogin;
                    hideProgressDialog();
                    if (response.code() == 400) {
                        try {
                            viewError(response.errorBody().string());
                        } catch (IOException e) {
                            e.printStackTrace();
                        }
                    }
                    else if (response.code() == 422) {
                        Toast.makeText(getApplicationContext(), "Đăng nhập thất bại! Tài khoản hoặc mật khẩu không đúng!", Toast.LENGTH_LONG).show();
                    }
                    else if (response.code() == 500) {
                        Toast.makeText(getApplicationContext(), "Đăng nhập thất bại! Có lỗi xảy ra trong quá trình đăng nhập. Vui lòng thử lại!", Toast.LENGTH_LONG).show();
                    }
                    else if (response.code() == 200) {
//                        if (cbremember.isChecked()) {
//
//                        SharedPreferencesHandler.writeString(context, Server.USER_NAME, edTenDangNhapDN.getText().toString());
////                                SharedPreferencesHandler.writeString(mContext, Constant.PASSWORD, mEdtPassword.getText().toString());
//                        SharedPreferencesHandler.writeBoolean(context, "remember_me", true);
//
//                    }

                        Call<Object> callUserInfo = mApi.getUserInfo(response.body().getTOKEN());
                        callUserInfo.enqueue(new Callback<Object>() {
                            @Override
                            public void onResponse(Call<Object> call, Response<Object> responseUser) {
                                String userQuyen = (String) ((LinkedTreeMap)((LinkedTreeMap) responseUser.body()).get("result")).get("quyen");
                                if (userQuyen.equals("admin") || userQuyen.equals("staff")) {
                                    Log.e(TAG, "Đăng nhập thành công! ");


//                        viewSucc(cbremember, "Đã đăng nhập thành công");
                                    SharedPreferencesHandler.writeString(context, Server.USER_NAME, edTenDangNhapDN.getText().toString());
                                    SharedPreferencesHandler.writeString(context, Server.TOKEN, response.body().getTOKEN());
                                    Intent i = new Intent(context, BanActivity.class);
                                    startActivity(i);
                                    Toast.makeText(getApplicationContext(), "Đăng nhập thành công!", Toast.LENGTH_SHORT).show();
                                    finish();
                                }
                                else {
                                    Toast.makeText(getApplicationContext(), "Đăng nhập thất bại! Tài khoản không được cấp quyền!", Toast.LENGTH_LONG).show();
                                }
                            }

                            @Override
                            public void onFailure(Call<Object> call, Throwable t) {

                            }
                        });

                    }

                }
                @Override
                public void onFailure(Call<Login> call, Throwable t) {
                    viewErrorExitApp();
                }
            });
        }
    }
//    private void Dangnhap(){
//        if (checkNullDangNhap()) {
//            viewProgressDialog("Đang đăng nhập ... ");
//            String ten_dang_nhap = edTenDangNhapDN.getText().toString().trim();
//            String mat_khau = edMatKhauDN.getText().toString().trim();
//            Call<Login> call = mApi.dangnhap(
//                    ten_dang_nhap,
//                    mat_khau);
//
//            call.enqueue(new Callback<Login>() {
//                @Override
//                public void onResponse(Call<Login> call, retrofit2.Response<Login> response) {
//                    hideProgressDialog();
//                    if (response.code() == 400) {
//                        try {
//                            viewError(response.errorBody().string());
//                        } catch (IOException e) {
//                            e.printStackTrace();
//                        }
//                    }
//                    if (response.code() == 200) {
////                        if (cbremember.isChecked()) {
////
////                        SharedPreferencesHandler.writeString(context, Server.USER_NAME, edTenDangNhapDN.getText().toString());
//////                                SharedPreferencesHandler.writeString(mContext, Constant.PASSWORD, mEdtPassword.getText().toString());
////                        SharedPreferencesHandler.writeBoolean(context, "remember_me", true);
////
////                    }
//                        Log.e(TAG, "Đăng nhập thành công! ");
//
//
////                        viewSucc(cbremember, "Đã đăng nhập thành công");
//                        SharedPreferencesHandler.writeString(context, Server.USER_NAME, edTenDangNhapDN.getText().toString());
//                        SharedPreferencesHandler.writeString(context, Server.TOKEN, response.body().getTOKEN());
//                        Intent i = new Intent(context, BanActivity.class);
//                        startActivity(i);
//                        Toast.makeText(getApplicationContext(), "Đăng nhập thành công!", Toast.LENGTH_SHORT).show();
//                        finish();
//                    }
//
//                }
//                @Override
//                public void onFailure(Call<Login> call, Throwable t) {
//                    viewErrorExitApp();
//                }
//            });
//        }
//    }
//    private void getIP(){
//        if(edIP.getText().toString().equals("")){
//            edIP.setError("Chưa nhập IP");
//        }
//        else{
//            ip = edIP.getText().toString();
////            SharedPreferencesHandler.writeString(context, Server.IP, ip);
////            IP = edIP.getText().toString();
//        }
//    }
    private boolean checkNullDangNhap() {

       if (edTenDangNhapDN.getText().toString().equals("")) {
            edTenDangNhapDN.setError("Chưa nhập tên đăng nhập");
            return false;
        } else if (edMatKhauDN.getText().toString().equals("")) {
            edMatKhauDN.setError("Chưa nhập mật khẩu");
            return false;
        } else return true;
    }
//    @Override
//    protected void onStart() {
//        super.onStart();
//        Bundle bundle = getIntent().getExtras();
//        if (null != bundle) {
//            String messsage = bundle.getString("message", null);
//            if (messsage != null) {
//                viewError(messsage);
//            }
//        } else {
//            boolean remember_me = SharedPreferencesHandler.getBoolean(context, "remember_me");
//            String token = SharedPreferencesHandler.getString(context, Server.TOKEN);
//
//            Log.e(TAG, "onStart: " + remember_me + token);
//
//            if (remember_me && !token.equals("")) {
//                startActivity(new Intent(this, MainActivity.class));
//            }
//        }
//
//    }
//    @Override
//    protected void onStop() {
//        super.onStop();
//    }

    private void AnhXa(){
        edTenDangNhapDN = (EditText) findViewById(R.id.edTenDangNhapDN);
        edMatKhauDN = (EditText) findViewById(R.id.edMatKhauDN);
//        edIP = (EditText) findViewById(R.id.edIP);
//        cbremember = (CheckBox) findViewById(R.id.cbremember);
        btnDongYDN = (Button) findViewById(R.id.btnDongYDN);
    }
    private void viewProgressDialog(String message) {
        if (null == progressDialog) {
            progressDialog = new ProgressDialog(this);
        }
        progressDialog.setMessage(message);
        progressDialog.setCancelable(false);
        progressDialog.show();
    }
    private void hideProgressDialog() {
        if (null != progressDialog) {
            progressDialog.dismiss();
        }
    }
    private void viewError(String message) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Cảnh báo");
        builder.setMessage(message);
        builder.setCancelable(false);
        builder.setNegativeButton("OK", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
            }
        });
        alertDialog = builder.create();
        alertDialog.show();
    }
    private void viewSucc(View view, String message) {
        snackbar = Snackbar.make(view, message, Snackbar.LENGTH_SHORT);
        snackbar.show();
    }
    private void viewErrorExitApp() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Cảnh báo");
        builder.setMessage("Không thể kết nối đến máy chủ ! \nVui lòng đăng nhập lại.");
        builder.setCancelable(false);
        builder.setNegativeButton("OK", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
                Intent it = new Intent(context, DangnhapActivity.class);
                startActivity(it);
            }
        });
        AlertDialog mAlertDialog = builder.create();
        mAlertDialog.show();
    }
}
