package com.linh.mycoffeemng.adapter;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.activity.HoadonActivity;
import com.linh.mycoffeemng.activity.SanphamActivity;
import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.model.Sanpham;
import com.linh.mycoffeemng.util.ItemClickListener;
import com.linh.mycoffeemng.util.Server;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class BanAdapter extends RecyclerView.Adapter<BanAdapter.ShowHolder> {

    private List<Ban> mangBan;
    private Context context;
    ShowHolder showHolder;
    Ban ban;

    class ShowHolder extends RecyclerView.ViewHolder{
        View itemView;
        CardView cardView;
        TextView txtTenBanAn;
        ImageView imBanAn;
        private ItemClickListener itemClickListener;
        public ShowHolder(final View itemView) {
            super(itemView);
            cardView = (CardView) itemView.findViewById(R.id.cardView);
            txtTenBanAn = (TextView) itemView.findViewById(R.id.txtTenBanAn);
            imBanAn = (ImageView) itemView.findViewById(R.id.imBanAn);

            //if(mangBan.get(getLayoutPosition()).getTrangthai().equals("da thanh toan")){
                imBanAn.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        if (onItemClickListener != null) {
                            onItemClickListener.onImgClick(itemView, getLayoutPosition());
                        }
                    }
                });
         //   }

        }
    }

    public BanAdapter(List<Ban> mangban, Context context) {
        this.mangBan = mangban;
        this.context = context;
    }

    @Override
    public ShowHolder onCreateViewHolder(ViewGroup viewGroup, int position) {

        View view = LayoutInflater.from(viewGroup.getContext())
                .inflate(R.layout.custom_layout_hienthiban, viewGroup, false);
        ShowHolder showHolder= new ShowHolder(view);
        return showHolder;
    }

    @Override
    public void onBindViewHolder(ShowHolder showHolder, final int position) {
        Ban ban = mangBan.get(position);
        showHolder.txtTenBanAn.setText("Bàn " +ban.getMaban());
        String kttinhtrang = ban.getTrangthai();
        if (kttinhtrang.equals("chua thanh toan")){
            showHolder.imBanAn.setImageResource(R.drawable.bando);
        }else if(kttinhtrang.equals("da thanh toan")){
            showHolder.imBanAn.setImageResource(R.drawable.banxanh);
        }
        else{
            showHolder.imBanAn.setImageResource(R.drawable.ban);
        }
        showHolder.cardView.setTag(position);
        final int maban = mangBan.get(position).getMaban();
        showHolder.cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String trangthaiban = mangBan.get(position).getTrangthai();

                Intent intent = new Intent(context, HoadonActivity.class);
                intent.putExtra("maban", maban);
                intent.putExtra("trangthaiban", trangthaiban);
                context.startActivity(intent);
            }
        });

    }
    public interface ItemClickListener {
        void onImgClick(View view, int position);
    }
    private ItemClickListener onItemClickListener;
    public void setItemClickListener(ItemClickListener clickListener) {
        onItemClickListener = clickListener;
    }
    @Override
    public int getItemCount() {
        return mangBan.size();
    }
}
