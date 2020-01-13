package com.linh.mycoffeemng.activity;

import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.adapter.BanAdapter;
import com.linh.mycoffeemng.adapter.HoadonAdapter;
import com.linh.mycoffeemng.adapter.LoaiAdapter;
import com.linh.mycoffeemng.adapter.SanphamAdapter;
import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Chitiethoadon;
import com.linh.mycoffeemng.model.Giohang;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.model.Loaisanpham;
import com.linh.mycoffeemng.model.Sanpham;
import com.linh.mycoffeemng.util.CheckConnection;
import com.linh.mycoffeemng.util.HttpClient;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Collection;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class SanphamActivity extends AppCompatActivity {
    Toolbar toolbarsanpham;
    Spinner spinloaisanpham;
    Button dengiohang;
    RecyclerView recyclerViewloai, recyclerViewSp;
    SanphamAdapter sanphamAdapter;
    ArrayList<Sanpham> mangSanpham;
    ArrayList<Loaisanpham> mangLoai;
    LoaiAdapter loaiAdapter;
    RecyclerView.LayoutManager layoutManager;
    String token;
    String TAG = SanphamActivity.class.getSimpleName();
    int ma_ban = 0;
    String trangthaiban = "";
    ArrayList<Chitiethoadon> mangchitiet = new ArrayList<>();
    HoadonAdapter hoadonAdapter;
    private AlertDialog alertDialog = null;
    private AlertDialog mAlertDialog;
    int id = 0;
    String ten = "";
    int gia = 0;
    List<Ban> mangban;
    Giohang giohang;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sanpham);
        AnhXa();
        token = SharedPreferencesHandler.getString(getApplicationContext(), Server.TOKEN);
        ma_ban = getIntent().getIntExtra("maban", -1);
        trangthaiban = getIntent().getStringExtra("trangthaiban" );
        if (CheckConnection.haveNetworkConnection(getApplicationContext())){

            ActionToolbar();
            addControlLoai();
            addControlSp();
            GetSanpham();
            GetLoai();
            dengiohang.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(SanphamActivity.this, HoadonActivity.class);
                    intent.putExtra("maban", ma_ban);
                    intent.putExtra("trangthaiban",trangthaiban );
                    startActivity(intent);
                }
            });

        }
        else {
            CheckConnection.ShowToast_Short(getApplicationContext(),"Bạn hãy kiểm tra lại kết nối");
            finish();
        }
    }

    private void GetLoai() {
        Call<List<Loaisanpham>> call = Server.getAPI().getLoai(token);
        call.enqueue(new Callback<List<Loaisanpham>>() {
            @Override
            public void onResponse(Call<List<Loaisanpham>> call, Response<List<Loaisanpham>> response) {
                if (response.body() != null) {
                    List<Loaisanpham> loaisanphams = response.body();
                    for (int i = 0; i < loaisanphams.size(); i++) {
                        mangLoai.add(loaisanphams.get(i));
                        Log.d(TAG, "onResponse" + loaisanphams.get(i).toString());
                    }
                    loaiAdapter.notifyDataSetChanged();
                }
            }

            @Override
            public void onFailure(Call<List<Loaisanpham>> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });
    }

    private void addControlLoai() {
        mangLoai = new ArrayList<Loaisanpham>();
        loaiAdapter = new LoaiAdapter(this, mangLoai);
        spinloaisanpham.setAdapter(loaiAdapter);
    }

    private void addControlSp() {
            layoutManager = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false);
            recyclerViewSp.setLayoutManager(layoutManager);
            mangSanpham = new ArrayList<>();
            sanphamAdapter = new SanphamAdapter(mangSanpham, SanphamActivity.this);
            recyclerViewSp.setAdapter(sanphamAdapter);
             sanphamAdapter.setItemClickListener(new SanphamAdapter.ItemClickListener() {
            @Override
            public void onItemClick(View view, int position) {
                id = mangSanpham.get(position).getMasp();
                ten = mangSanpham.get(position).getTensp();
                gia = mangSanpham.get(position).getDongia();
//                String ghichu = null;
//                ArrayList<Chitiethoadon> chitiethoadon = new ArrayList<>();
//                for (int i=0; i<chitiethoadon.size(); i++) {
//                    Chitiethoadon chitiet = chitiethoadon.get(i);
//                    if (id == chitiet.getMasp()) {
//                        chitiet.setSoluong(chitiet.getSoluong() + 1);
//                        chitiet.setThanhtien(chitiet.getDongia() * chitiet.getSoluong());
//                    }
//                    Chitiethoadon giohang = new Chitiethoadon(null, id, 1, mangSanpham.get(position).getDongia(), mangSanpham.get(position).getDongia() * chitiet.getSoluong(), "dang cho pha", null, "mangSanpham.get(position).getTensp()");
//                    Toast.makeText(getApplicationContext(),
//                        " Thêm sản phẩm" + mangSanpham.get(position).getMasp() + " thành công", Toast.LENGTH_SHORT)
//                        .show();
                    themvaogiohang();
            }
        });

    }

    private void themvaogiohang() {
        AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_them_so_luong_sp, null);
        Button btnXacNhan = dialogView.findViewById(R.id.btn_xacnhan);
        Button btnHuy = dialogView.findViewById(R.id.btn_huy);
        final EditText edtSanLuong = dialogView.findViewById(R.id.edt_soluongmua);
        final EditText edtGhichu = dialogView.findViewById(R.id.edt_ghichu);

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
                int so_luong = Integer.parseInt(edtSanLuong.getText().toString());
                String ghi_chu = edtGhichu.getText().toString();
                int ma_sp = id;

                Call<Giohang> call = Server.getAPI().postGiohang(ma_ban, ma_sp, so_luong, ghi_chu, token);
                        call.enqueue(new Callback<Giohang>() {
                            @Override
                            public void onResponse(Call<Giohang> call, Response<Giohang> response) {
                                mAlertDialog.dismiss();
                                try {

                                    if (response.code() == 200) {
//                                        viewSucc(mImageView, "Đã đặt hàng thành công !");
                                        Toast.makeText(getApplicationContext(),
                                                " Thêm sản phẩm" + id + " thành công", Toast.LENGTH_SHORT)
                                                .show();
//                                        if(trangthaiban.equals("trong")){
//                                            trangthaiban = "co khach";
//                                        }
                                    }
                                    if (response.code() == 500 && null != response.errorBody()) {
                                        String err = "";
                                        err += response.errorBody().string();
                                        Toast.makeText(getApplicationContext(),
                                                " Thêm sản phẩm" + id + " thất bại", Toast.LENGTH_SHORT)
                                                .show();
                                    }

                                } catch (Exception e) {
                                    e.printStackTrace();
                                }
                            }

                            @Override
                            public void onFailure(Call<Giohang> call, Throwable t) {
                                mAlertDialog.dismiss();
                            }
                        });


        }
    });
        dialogBuilder.setView(dialogView);
        mAlertDialog = dialogBuilder.create();
        mAlertDialog.show();

    }

    private void GetSanpham() {
        Call<List<Sanpham>> call = Server.getAPI().getSanpham(token);
        call.enqueue(new Callback<List<Sanpham>>() {
            @Override
            public void onResponse(Call<List<Sanpham>> call, Response<List<Sanpham>> response) {
                if (response.body() != null) {
                    List<Sanpham> sanphams = response.body();
                    for (int i = 0; i < sanphams.size(); i++) {
                        mangSanpham.add(sanphams.get(i));
                        Log.d(TAG, "onResponse" + sanphams.get(i).toString());
                    }
                    sanphamAdapter.notifyDataSetChanged();
                }
            }

            @Override
            public void onFailure(Call<List<Sanpham>> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });
    }

    private void ActionToolbar() {
        setSupportActionBar(toolbarsanpham);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbarsanpham.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();

            }
        });
    }

    private void AnhXa() {
        toolbarsanpham = (Toolbar) findViewById(R.id.toolbarsanpham);
        recyclerViewSp = (RecyclerView) findViewById(R.id.recyclerviewSp);
        spinloaisanpham = (Spinner) findViewById(R.id.spinloaisanpham);
//        mangLoai = new ArrayList<>();
//        loaiAdapter = new LoaiAdapter(getApplicationContext(), mangLoai);
//        spinloaisanpham.setAdapter(loaiAdapter);
        dengiohang = (Button) findViewById(R.id.btnDigiohang);

    }

}
