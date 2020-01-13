package com.linh.mycoffeemng.activity;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.BaseAdapter;
import android.widget.GridView;
import android.support.v7.widget.Toolbar;
import android.widget.Toast;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.adapter.BanAdapter;
import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.data.ConnectServer;
import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Login;
import com.linh.mycoffeemng.util.CheckConnection;
import com.linh.mycoffeemng.util.NotificationUtil;
import com.linh.mycoffeemng.util.Server;
import com.linh.mycoffeemng.util.SharedPreferencesHandler;
import com.pusher.client.Pusher;
import com.pusher.client.PusherOptions;
import com.pusher.client.channel.Channel;
import com.pusher.client.channel.PusherEvent;
import com.pusher.client.channel.SubscriptionEventListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
public class BanActivity extends AppCompatActivity {
    Toolbar toolbar;
    //    GridView gridView;
    BanAdapter banAdapter;
    ArrayList<Ban> mangBan;
    String TAG = BanActivity.class.getSimpleName();
    private API mApi;
    //    private AlertDialog mAlertDialog;
    private String token;
    private RecyclerView recyclerView;
    RecyclerView.LayoutManager layoutManager;

    @Override
    protected void onResume() {
        super.onResume();
        getBan();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        final Context self = this;
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_hienthiban);


        mApi = Server.getAPI();
        toolbar = (Toolbar) findViewById(R.id.toolbarBan);
        recyclerView = (RecyclerView) findViewById(R.id.recyclerview);
//
        ActionToolbar();
        token = SharedPreferencesHandler.getString(getApplicationContext(), Server.TOKEN);
//        token = Server.TOKEN;
//        Toast.makeText(getApplicationContext(), token, Toast.LENGTH_SHORT).show();
        addControl();
        getBan();
        receivePusher();
        trongBan();
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

    private void receivePusher(){
        final Context self = this;
        PusherOptions options = new PusherOptions();
        options.setCluster("ap1");
        Pusher pusher = new Pusher("e4ec9d179835b07f69e2", options);

        Channel channel = pusher.subscribe("thanhtoan-notify");
        channel.bind("App\\Events\\ThanhtoanPusherEvent", new SubscriptionEventListener() {
            //            Map<String, Object> eventData = new HashMap<String, Object>();
//            PusherEvent pusherEvent = new PusherEvent();
            @Override
            public void onEvent(PusherEvent event) {
                try {
                    JSONObject messageObj = new JSONObject(event.getData());
                    NotificationUtil.sendNotification(self, R.drawable.homeicon, "", messageObj.get("message").toString());
                    System.out.println(">>> Received event with data: " + event.toString());
                    mangBan.clear();
                    getBan();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });


        pusher.connect();
    }
    private void addControl() {
        recyclerView.setHasFixedSize(true);
        // Create 2 col
        layoutManager = new GridLayoutManager(BanActivity.this, 2);
        recyclerView.setLayoutManager(layoutManager);
        mangBan = new ArrayList<>();
        banAdapter = new BanAdapter(mangBan, BanActivity.this);
        recyclerView.setAdapter(banAdapter);
    }


    public void getBan() {
        Call<List<Ban>> call =   mApi.getBan(token);
        call.enqueue(new Callback<List<Ban>>() {
            @Override
            public void onResponse(Call<List<Ban>> call, Response<List<Ban>> response) {
                mangBan.clear();
                List<Ban> mangBan1 = (List<Ban>) response.body();
                for (int i = 0; i<mangBan1.size() ; i++) {
                    mangBan.add(mangBan1.get(i));
                    Log.d(TAG, "onResponse" + mangBan1.get(i).toString());
                }
                banAdapter.notifyDataSetChanged();
            }

            @Override
            public void onFailure(Call<List<Ban>> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });
//            @Override
//            public void onResponse(Call<Ban> call, Object response) {
//                Toast.makeText(getApplicationContext(), response.toString(), Toast.LENGTH_SHORT).show();
//                List<Ban> mangBan = (List<Ban>) response.body();
//                for (int i = 0; i<mangBan.size() ; i++) {
//                    mangBan.add(mangBan.get(i));
//                    Log.d(TAG, "onResponse" + mangBan.get(i).toString());
//                    banAdapter.notifyDataSetChanged();
//                }
//
//            }


    }

//    private void loadAnswers() {
//        mApi.Laydulieuban(mToken).enqueue(new Callback<Ban>() {
//            @Override
//            public void onResponse(Call<Ban> call, retrofit2.Response<Ban> response) {
//                if(response.isSuccessful()) {
//                    banAdapter.updateAnswers((List<Ban>) response.body());
//                    Log.d("BanActivity", "posts loaded from API");
//                }else {
//                    int statusCode  = response.code();
//                    // handle request errors depending on status code
//                }
//            }
//
//            @Override
//            public void onFailure(Call<Ban> call, Throwable t) {
//                showErrorMessage();
//                Log.d("BanActivity", "error loading from API");
//            }
//
//        });
//    }

    //    private void showErrorMessage() {
//
//    }
    private void trongBan(){
        banAdapter.setItemClickListener(new BanAdapter.ItemClickListener() {
            @Override
            public void onImgClick(View view, int position) {
                int id = mangBan.get(position).getMaban();
                Call<String> call = mApi.trongBan(id, token);
                call.enqueue(new Callback<String>() {
                    @Override
                    public void onResponse(Call<String> call, Response<String> response) {
                        if(response.body() != null && response.body().equals("ok")){
                            mangBan.clear();
                            getBan();

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

    private void ActionToolbar () {
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }

}
