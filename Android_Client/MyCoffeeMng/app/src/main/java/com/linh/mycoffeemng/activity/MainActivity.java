package com.linh.mycoffeemng.activity;

import android.content.Context;
import android.content.Intent;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.support.design.widget.NavigationView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ViewFlipper;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.model.Giohang;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.util.NotificationUtil;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;
import com.pusher.client.PusherOptions;
import com.pusher.client.channel.PusherEvent;
import com.pusher.client.connection.ConnectionEventListener;
import com.pusher.client.connection.ConnectionState;
import com.pusher.client.connection.ConnectionStateChange;
import com.squareup.picasso.Picasso;
import java.util.ArrayList;

import com.pusher.client.Pusher;
import com.pusher.client.channel.Channel;
import com.pusher.client.channel.SubscriptionEventListener;

import org.json.JSONException;
import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class MainActivity extends AppCompatActivity {
    ImageView dangxuat;
    Toolbar toolbar;
    DrawerLayout drawerLayout;
    NavigationView navigationView;
    ViewFlipper viewFlipper;
    Button buttonOrder, buttonHoadon;
    TextView txtTenNhanVien_Navigation;
    String token;
    private AlertDialog mAlertDialog;
    Hoadon hoadon;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        final Context self = this;
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        AnhXa();
        ActionBar();
        ActionViewFlipper();
        token = SharedPreferencesHandler.getString(getApplicationContext(), Server.TOKEN);
        Toast.makeText(getApplicationContext(), (String)token, Toast.LENGTH_SHORT).show();
        buttonOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this,BanActivity.class);
                startActivity(intent);
            }
        });
        buttonHoadon.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                thanhtoan();
            }
        });

        dangxuat.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, DangnhapActivity.class);
                startActivity(intent);
            }
        });

        PusherOptions options = new PusherOptions();
        options.setCluster("ap1");
        Pusher pusher = new Pusher("e4ec9d179835b07f69e2", options);

        Channel channel = pusher.subscribe("header-notify");
        channel.bind("App\\Events\\PhachePusherEvent", new SubscriptionEventListener() {
            //            Map<String, Object> eventData = new HashMap<String, Object>();
//            PusherEvent pusherEvent = new PusherEvent();
            @Override
            public void onEvent(PusherEvent event) {
                try {
                    JSONObject messageObj = new JSONObject(event.getData());
                    NotificationUtil.sendNotification(self, R.drawable.homeicon, "Có món đã chế biến", messageObj.get("message").toString());
                    System.out.println(">>> Received event with data: " + event.toString());
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });

        pusher.connect();
    }
    private void thanhtoan(){
        AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_thanhtoan, null);
        Button btnXacNhan = dialogView.findViewById(R.id.btn_xacnhan);
        Button btnHuy = dialogView.findViewById(R.id.btn_huy);
        final EditText edtban = dialogView.findViewById(R.id.edt_maban);

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
                int ma_ban = Integer.parseInt(edtban.getText().toString());

                Call<Hoadon> call = Server.getAPI().thanhtoan(ma_ban, token);
                call.enqueue(new Callback<Hoadon>() {
                    @Override
                    public void onResponse(Call<Hoadon> call, Response<Hoadon> response) {
                        mAlertDialog.dismiss();
                        try {
                            if (response.body() != null) {
                                hoadon = response.body();
                                hienthiHD();
                            }
                            if (response.code() == 500 && null != response.errorBody()) {
                                String err = "";
                                err += response.errorBody().string();

                            }

                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }

                    @Override
                    public void onFailure(Call<Hoadon> call, Throwable t) {
                        mAlertDialog.dismiss();
                    }
                });


            }
        });
        dialogBuilder.setView(dialogView);
        mAlertDialog = dialogBuilder.create();
        mAlertDialog.show();
    }

    private void hienthiHD() {
        AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_hienthi_hoadon, null);
        Button btnXacNhan = dialogView.findViewById(R.id.btn_xacnhan);
        TextView edtban = dialogView.findViewById(R.id.textView5);
        edtban.setText("Tổng hóa đơn: " + hoadon.getTongtien() + "VND");

        btnXacNhan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (mAlertDialog.isShowing()) {

                    mAlertDialog.dismiss();
                }
            }
        });
        dialogBuilder.setView(dialogView);
        mAlertDialog = dialogBuilder.create();
        mAlertDialog.show();
    }


    private void ActionViewFlipper() {
        ArrayList<String> mangquangcao = new ArrayList<>();
        mangquangcao.add("https://znews-photo.zadn.vn/w660/Uploaded/vhuowar/2017_08_09/k1.jpg");
        mangquangcao.add("https://znews-photo.zadn.vn/w660/Uploaded/vhuowar/2017_08_09/13173816_961692197259408_8369572630084714614_n.jpg");
        mangquangcao.add("https://vietblend.vn/wp-content/uploads/2018/12/do-uong-da-xay.jpg");
        mangquangcao.add("https://vietblend.vn/wp-content/uploads/2018/12/cocktail.jpg");
        for (int i=0; i<mangquangcao.size();i++){
            ImageView imageView = new ImageView(getApplicationContext());
            Picasso.get().load(mangquangcao.get(i)).into(imageView);
            imageView.setScaleType(ImageView.ScaleType.FIT_XY);
            viewFlipper.addView(imageView);
        }
        viewFlipper.setFlipInterval(5000);
        viewFlipper.setAutoStart(true);
        Animation animation_slide_in = AnimationUtils.loadAnimation(getApplicationContext(),R.anim.slide_in_right);
        Animation animation_slide_out = AnimationUtils.loadAnimation(getApplicationContext(),R.anim.slide_out_right);
        viewFlipper.setInAnimation(animation_slide_in);
        viewFlipper.setOutAnimation(animation_slide_out);

    }

    private void ActionBar() {
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationIcon(android.R.drawable.ic_menu_sort_by_size);
        ActionBarDrawerToggle drawerToggle = new ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.mo, R.string.dong){

            @Override
            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);
            }

            @Override
            public void onDrawerClosed(View drawerView) {
                super.onDrawerClosed(drawerView);
            }
        };
        navigationView.setItemIconTintList(null);
        String tendn = SharedPreferencesHandler.getString(this, Server.USER_NAME);
        txtTenNhanVien_Navigation.setText(tendn);
//        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                drawerLayout.openDrawer(GravityCompat.START);
//            }
//        });
    }

    private void AnhXa(){
        toolbar = (Toolbar) findViewById(R.id.toolbar);
        drawerLayout = (DrawerLayout) findViewById(R.id.drawerLayout);
        navigationView = (NavigationView) findViewById(R.id.navigationview);
        viewFlipper = (ViewFlipper) findViewById(R.id.viewflipper);
        buttonOrder = (Button) findViewById(R.id.buttonOrder);
        buttonHoadon = (Button) findViewById(R.id.buttonHoadon);
        dangxuat = (ImageView) findViewById(R.id.dangxuat);
        View view = navigationView.inflateHeaderView(R.layout.layout_header_navigation_main);
        txtTenNhanVien_Navigation = (TextView) view.findViewById(R.id.txtTenNhanVienNavigation);

    }
}
