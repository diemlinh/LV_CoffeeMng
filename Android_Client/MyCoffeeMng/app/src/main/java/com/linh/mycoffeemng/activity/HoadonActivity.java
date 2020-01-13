package com.linh.mycoffeemng.activity;

import android.app.ActionBar;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.support.v7.widget.Toolbar;
import android.widget.Toast;

import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.adapter.HoadonAdapter;
import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Chitiethoadon;
import com.linh.mycoffeemng.model.Giohang;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HoadonActivity extends AppCompatActivity {
    private TextView txtBan;
    private TextView txtNgay;
    private TextView txtTongtien;
    Toolbar toolbarHoadon;
    Button buttonPhache, buttonThem;
    String TAG = HoadonActivity.class.getSimpleName();
    Hoadon hoadon;
    ArrayList<Chitiethoadon> mangChitiet;
    int id = 0;
    String trangthaiban = "";
    String token;
    API api;
    RecyclerView recyclerViewHoadon;
    private HoadonAdapter hoadonAdapter;
    RecyclerView.LayoutManager layoutManager;
    private AlertDialog mAlertDialog;
    private ProgressDialog mProgressDialog;

    @Override
    protected void onResume() {
        super.onResume();
        getHoadon();
        getChitiet();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hoadon);
        AnhXa();
        ActionToolbar();
        getban();
        api = Server.getAPI();
        token = SharedPreferencesHandler.getString(getApplicationContext(), Server.TOKEN);
//        getHoadon();
//        getChitiet();
        capnhat();
        buttonThem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(HoadonActivity.this, SanphamActivity.class);
                intent.putExtra("maban", id);
                intent.putExtra("trangthaiban", trangthaiban);
                startActivity(intent);
            }
        });
        buttonPhache.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (mangChitiet.size() > 0) {
                    viewProgressDialog("Đang đặt hàng ... ");
                    Integer tong_tien = hoadonAdapter.getTongtien();
                    Call<String> call =  api.goimon(id, tong_tien, token);
                    call.enqueue(new Callback<String>() {
                        @Override
                        public void onResponse(Call<String> call, Response<String> response) {
                            hideProgressDialog();

                            if(null != response.body() && response.body().equals("Order thành công!")) {
                                mangChitiet.clear(); //Xóa các dữ liệu trong giỏ hàng
                                getChitiet();
                                Toast.makeText(getApplicationContext(),
                                        response.body(), Toast.LENGTH_LONG)
                                        .show();
                            }

                        }

                        @Override
                        public void onFailure(Call<String> call, Throwable t) {

                        }
                    });
                }
            }
        });

    }

    private void viewProgressDialog(String message) {
        if (null == mProgressDialog) {
            mProgressDialog = new ProgressDialog(this);
        }
        mProgressDialog.setMessage(message);
        mProgressDialog.setCancelable(false);
        mProgressDialog.show();
    }
    private void hideProgressDialog() {
        if (null != mProgressDialog) {
            mProgressDialog.dismiss();
        }
    }
//    private void viewProgressDialog(String message) {
//        if (null == mProgressDialog) {
//            mProgressDialog = new ProgressDialog(getApplicationContext());
//        }
//        mProgressDialog.setMessage(message);
//        mProgressDialog.show();
//    }
//    private void hideProgressDialog() {
//        if (null != mProgressDialog) {
//            mProgressDialog.dismiss();
//        }
//    }

    private void getban() {
        System.out.println(">>> getBan");
        id = getIntent().getIntExtra("maban", -1);
        trangthaiban = getIntent().getStringExtra("trangthaiban" );
    }

    private void ActionToolbar () {
        setSupportActionBar(toolbarHoadon);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbarHoadon.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Call<String> call = api.Xoagh(id, token);
                call.enqueue(new Callback<String>() {
                    @Override
                    public void onResponse(Call<String> call, Response<String> response) {
//                        if (response.body().equals("Xóa thành công")) {
//
////                            Toast.makeText(getApplicationContext(),
////                                    " Giỏ hàng đã hủy ", Toast.LENGTH_LONG)
////                                    .show();
//                        }
//                        finish();
//                        Intent intent = new Intent(HoadonActivity.this, BanActivity.class);
                        //startActivity(intent);

                    }
                    @Override
                    public void onFailure(Call<String> call, Throwable t) {
                        Log.e(TAG, "onFailure: " + t.getMessage());
                    }
                });

                finish();
            }
        });
    }
    private void getHoadon() {
        System.out.println(">>> getHoadon");
        Call<Hoadon> call = api.getHoadon(id,token);
        call.enqueue(new Callback<Hoadon>() {
            @Override
            public void onResponse(Call<Hoadon> call, Response<Hoadon> response) {
                hoadon = response.body();
                txtBan.setText("Bàn " + hoadon.getMaban());
                txtNgay.setText(hoadon.getNgaylap());
//                    txtTongtien.setText("VND: " + hoadon.getTongtien().toString());

//                Toast.makeText(getApplicationContext(),
//                        " Thành công "+ hoadon, Toast.LENGTH_LONG)
//                        .show();
            }
            @Override
            public void onFailure(Call<Hoadon> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });



    }
    private void getChitiet() {
//        if (trangthaiban.equals("trong")){
//            Toast.makeText(getApplicationContext(),
//                    " Bàn đang trống ", Toast.LENGTH_LONG)
//                    .show();
//            txtTongtien.setText("VNĐ: " + 0);
//        }
//        else {
        System.out.println(">>> getChitiet"+id);
        Call<List<Chitiethoadon>> call = api.getChitiet(id, token);
        call.enqueue(new Callback<List<Chitiethoadon>>() {
            @Override
            public void onResponse(Call<List<Chitiethoadon>> call, Response<List<Chitiethoadon>> response) {
                System.out.println(">>> Chitiet RS: "+response.body());
                if (response.body() == null) {
                    txtTongtien.setText("VNĐ: " + 0);
                    Toast.makeText(getApplicationContext(),
                            " Bàn đang trống ", Toast.LENGTH_LONG).show();
                } else {
                    mangChitiet.clear();
                    List<Chitiethoadon> chitiethoadon = response.body();
                    for (int i = 0; i < chitiethoadon.size(); i++) {
                        mangChitiet.add(chitiethoadon.get(i));

                        Log.d(TAG, "onResponse" + chitiethoadon.get(i).toString());

                        hoadonAdapter.notifyDataSetChanged();
                        txtTongtien.setText("VNĐ: " + hoadonAdapter.getTongtien());
                    }
                }
            }
            @Override
            public void onFailure(Call<List<Chitiethoadon>> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });
    }
    private void capnhat() {
        System.out.println(">>> capnhat");
        final AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(this);
        final LayoutInflater inflater = this.getLayoutInflater();
        hoadonAdapter.setItemClickListener(new HoadonAdapter.ItemClickListener() {

            @Override
            public void onItemClick(View view, int position) {
                View dialogView = inflater.inflate(R.layout.dialog_sua_gio_hang, null);
                Button btnXacNhan = dialogView.findViewById(R.id.btn_xacnhan);
                Button btnHuy = dialogView.findViewById(R.id.btn_huy);
//                final EditText edtSoluong = dialogView.findViewById(R.id.edt_soluong);
                final EditText edtGhichu = dialogView.findViewById(R.id.edt_ghichuSua);
                final int masp = mangChitiet.get(position).getMasp();
                btnHuy.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        if (mAlertDialog.isShowing()) {

                            mAlertDialog.dismiss();
                        }
                    }
                });

                btnXacNhan.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        mAlertDialog.dismiss();
//                        int so_luong = Integer.parseInt(edtSoluong.getText().toString());
                        String ghi_chu = edtGhichu.getText().toString();
                        int id = masp;

                        Call<String> call = api.suaGiohang( id, ghi_chu, token);
                        call.enqueue(new Callback<String>() {
                            @Override
                            public void onResponse(Call<String> call, Response<String> response) {

                                try {

                                    if (response.body().equals("Cập nhật thành công")) {
//                                        viewSucc(mImageView, "Đã đặt hàng thành công !");
                                        Toast.makeText(getApplicationContext(),
                                                " Cập nhật thành công", Toast.LENGTH_SHORT)
                                                .show();
                                        mangChitiet.clear();
                                        getChitiet();
                                    }
                                    if (response.body().equals("Cập nhật không thành công")) {
//                                        String err = "";
//                                        err += response.errorBody().string();
                                        Toast.makeText(getApplicationContext(),
                                                " Cập nhật thất bại", Toast.LENGTH_SHORT)
                                                .show();
                                    }

                                } catch (Exception e) {
                                    e.printStackTrace();
                                }
                            }

                            @Override
                            public void onFailure(Call<String> call, Throwable t) {
                                mAlertDialog.dismiss();
                            }
                        });


                    }
                });
                dialogBuilder.setView(dialogView);
                mAlertDialog = dialogBuilder.create();
                mAlertDialog.show();
            }
            @Override
            public void onCongClick(View view, final int position) {
                Integer id = mangChitiet.get(position).getMasp();
                Integer so_luong = mangChitiet.get(position).getSoluong() +1;
                Call<String> call = api.capnhat(id, so_luong, token);
                call.enqueue(new Callback<String>() {
                    @Override
                    public void onResponse(Call<String> call, Response<String> response) {

                        Toast.makeText(getApplicationContext(),
                                "Cập nhật thành công!", Toast.LENGTH_LONG)
                                .show();
                        mangChitiet.clear();
                        getChitiet();
//                        recreate();
                    }
                    @Override
                    public void onFailure(Call<String> call, Throwable t) {
                        Log.e(TAG, "onFailure: " + t.getMessage());
                    }
                });
            }

            @Override
            public void onTruClick(View view, int position) {

                final Integer hoadonId = hoadon.getMahoadon();
                final Chitiethoadon cthd = mangChitiet.get(position);
                final Integer sanphampId = cthd.getMasp();
                final Integer soluongGiohang = cthd.getSoluong();

                System.out.println(">>> hoadonId: "+ hoadonId);
                System.out.println(">>> sanphamId: "+ sanphampId);

                Call<String> call = api.getSolgPhacheTrongHD(hoadonId, sanphampId, token);
                call.enqueue(new Callback<String>() {
                    @Override
                    public void onResponse(Call<String> call, Response<String> response) {
                        if(null != response.body()
                                && Integer.parseInt(response.body()) >= soluongGiohang) {
                            System.out.println(">>> da pha che het so luong");
                            Toast.makeText(getApplicationContext(),"Số lượng thức uống đã pha chế không thể cancel", Toast.LENGTH_LONG).show();
                        } else {
                            Integer so_luong = cthd.getSoluong() -1;
                            Call<String> callCapnhat = api.capnhat(sanphampId, so_luong, token);
                            callCapnhat.enqueue(new Callback<String>() {
                                @Override
                                public void onResponse(Call<String> call, Response<String> response) {
                                    if(response.body().equals("success"))
                                        Toast.makeText(getApplicationContext(),"Cập nhật thành công!", Toast.LENGTH_LONG).show();
                                    mangChitiet.clear();
                                    getChitiet();
                                }
                                @Override
                                public void onFailure(Call<String> call, Throwable t) {
                                    Log.e(TAG, "onFailure: " + t.getMessage());
                                }
                            });
                        }
                    }
                    @Override
                    public void onFailure(Call<String> call, Throwable t) {
                        Log.e(TAG, "onFailure: " + t.getMessage());
                    }
                });


            }

        });
    }

    private void AnhXa() {
        txtBan = findViewById(R.id.txtBan);
        txtNgay = findViewById(R.id.txtNgay);
        txtTongtien = findViewById(R.id.txtTongtien);
        toolbarHoadon = findViewById(R.id.toolbarHoadon);
        buttonThem = findViewById(R.id.buttonThem);
        buttonPhache = findViewById(R.id.buttonPhache);
        recyclerViewHoadon = findViewById(R.id.recyclerviewHoadon);
        layoutManager = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false);
        recyclerViewHoadon.setLayoutManager(layoutManager);
        mangChitiet = new ArrayList<>();
        hoadonAdapter = new HoadonAdapter(mangChitiet, HoadonActivity.this);
//        hoadonAdapter.setOnClickListener(this);
        recyclerViewHoadon.setAdapter(hoadonAdapter);

    }

}
