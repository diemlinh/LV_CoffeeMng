package com.linh.mycoffeemng.adapter;

import android.annotation.TargetApi;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.icu.text.DecimalFormat;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.activity.HoadonActivity;
import com.linh.mycoffeemng.data.API;
import com.linh.mycoffeemng.model.Ban;
import com.linh.mycoffeemng.model.Chitiethoadon;
import com.linh.mycoffeemng.model.Giohang;
import com.linh.mycoffeemng.model.Hoadon;
import com.linh.mycoffeemng.model.Sanpham;
import com.linh.mycoffeemng.util.ItemClickListener;
import com.linh.mycoffeemng.util.Server;
import com.squareup.picasso.Picasso;

import java.util.ConcurrentModificationException;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.support.constraint.Constraints.TAG;

public class HoadonAdapter extends RecyclerView.Adapter<HoadonAdapter.ShowHolder> {

    private List<Giohang> giohangs;
    private List<Chitiethoadon> mangChitiet;
    private Context context;
    private onClickListener onClickListener;

    class ShowHolder extends RecyclerView.ViewHolder{
        View itemView;
        CardView cardView;
        TextView txtTensp, txtDongia, txtThanhtien, Ghichu;
        Button btntru, btncong, btnSoluong;
        public ShowHolder(final View itemView) {
            super(itemView);

            cardView = (CardView) itemView.findViewById(R.id.cardView);
            txtTensp = (TextView) itemView.findViewById(R.id.txtTensp);
            btnSoluong = (Button) itemView.findViewById(R.id.btnSoluong);
            txtDongia = (TextView) itemView.findViewById(R.id.txtDongia);
            txtThanhtien = (TextView) itemView.findViewById(R.id.txtThanhtien);
            Ghichu = (TextView) itemView.findViewById(R.id.Ghichu);
            btntru = (Button) itemView.findViewById(R.id.btntru);
            btncong = (Button) itemView.findViewById(R.id.btncong);
            btncong.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (onItemClickListener != null) {
                        onItemClickListener.onCongClick(itemView, getLayoutPosition());
                    }
                }
            });
            btntru.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (onItemClickListener != null) {
                        onItemClickListener.onTruClick(itemView, getLayoutPosition());
                    }
                }
            });
            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (onItemClickListener != null) {
                        onItemClickListener.onItemClick(itemView, getLayoutPosition());
                    }
                }
            });



        }
    }

    public HoadonAdapter(List<Chitiethoadon> chitietList, Context context) {
        this.mangChitiet = chitietList;
        this.context = context;
    }

    @Override
    public HoadonAdapter.ShowHolder onCreateViewHolder(ViewGroup viewGroup, int position) {

        View view = LayoutInflater.from(viewGroup.getContext())
                .inflate(R.layout.custom_layout_hoadon, viewGroup, false);
        HoadonAdapter.ShowHolder showHolder= new HoadonAdapter.ShowHolder(view);
        return showHolder;
    }

    @Override
    public void onBindViewHolder(final HoadonAdapter.ShowHolder showHolder, final int position) {
//        for (int i=0; i<mangChitiet.size();i++) {
//            Chitiethoadon chitiethoadon = mangChitiet.get(position);
//
//        }
        final Chitiethoadon chitiethoadon = mangChitiet.get(position);
        showHolder.txtTensp.setText(chitiethoadon.getTensp());
        showHolder.btnSoluong.setText(chitiethoadon.getSoluong().toString());

        int sl = Integer.parseInt(showHolder.btnSoluong.getText().toString());
        if(sl == 1){
            showHolder.btntru.setVisibility(View.INVISIBLE);
        } else {
            showHolder.btntru.setVisibility(View.VISIBLE);
        }
        showHolder.txtDongia.setText(chitiethoadon.getDongia().toString());
        showHolder.txtThanhtien.setText(chitiethoadon.getThanhtien().toString());
//        String trangthai = chitiethoadon.getTrangthai();
//        if (trangthai.equals("da pha")){
//            showHolder.txtTensp.setTextColor(Color.parseColor("#FF0000"));
//        }
        String ghichu = chitiethoadon.getGhichu();
        if (ghichu != null){
            showHolder.Ghichu.setText(chitiethoadon.getGhichu());
        }
//        showHolder.btncong.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Integer slmoi = Integer.parseInt(showHolder.btnSoluong.getText().toString() )+1;
//                Integer slhientai = giohang.getSoluong();
//                Integer giaht = giohang.getThanhtien();
//                giohang.setSoluong(slmoi);
//                Integer giamoi = (giaht * slmoi /slhientai);
//                giohang.setThanhtien(giamoi);
//                showHolder.btnSoluong.setText(slmoi.toString());
//                showHolder.txtThanhtien.setText(giamoi.toString());
//                HoadonActivity.getHoadon();
//
//            }
//        });
//        showHolder.btntru.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
////                int id = chitiethoadon.getMasp();
////                Integer so_luong = Integer.parseInt(showHolder.btnSoluong.getText().toString() )-1;
////                Call<String> call = api.capnhat(id, so_luong, token);
////                call.enqueue(new Callback<String>() {
////                    @Override
////                    public void onResponse(Call<String> call, Response<String> response) {
////                        String result = response.body();
////
////                     Toast.makeText(context,
////                        result, Toast.LENGTH_LONG)
////                        .show();
////                    }
////                    @Override
////                    public void onFailure(Call<String> call, Throwable t) {
////                        Log.e(TAG, "onFailure: " + t.getMessage());
////                    }
////                });
//                Integer so_luong = Integer.parseInt(showHolder.btnSoluong.getText().toString() )-1;
//                Integer slhientai = chitiethoadon.getSoluong();
//                Integer giaht = chitiethoadon.getThanhtien();
//                chitiethoadon.setSoluong(so_luong);
//                Integer giamoi = (giaht * so_luong /slhientai);
//                chitiethoadon.setThanhtien(giamoi);
//                showHolder.txtThanhtien.setText(giamoi.toString());
//                HoadonActivity.getHoadon();
//                if(so_luong <2){
//                    showHolder.btntru.setVisibility(View.INVISIBLE);
//                    showHolder.btncong.setVisibility(View.VISIBLE);
////                    showHolder.btnSoluong.setText(so_luong.toString());
//                }
//                else{showHolder.btntru.setVisibility(View.VISIBLE);
//                    showHolder.btncong.setVisibility(View.VISIBLE);
////                    showHolder.btnSoluong.setText(so_luong.toString());
//
//                }
//            }
//        });
        showHolder.cardView.setTag(position);
//        final int masp = mangChitiet.get(position).getMasp();
    }

    public interface ItemClickListener {
        void onItemClick(View view, int position);
        void onCongClick(View view, int position);
        void onTruClick(View view, int position);
    }
    private ItemClickListener onItemClickListener;
    public void setItemClickListener(ItemClickListener clickListener) {
        onItemClickListener = clickListener;
    }
    public void setOnClickListener(HoadonAdapter.onClickListener onClickListener) {
        this.onClickListener = onClickListener;
    }
    public interface onClickListener {
//        void onItemClick(int position, String idSanPham);

        void onItemDeleteClick(int position, int ma_sp);

        void onEditClick(int positon, int ma_sp);
    }
    @Override
    public int getItemCount() {
        return mangChitiet.size();
    }
    public int getTongtien(){
        int tongtien = 0;
        for (int i = 0; i < mangChitiet.size(); i++) {
            tongtien += (mangChitiet.get(i).getDongia() * mangChitiet.get(i).getSoluong());
        }
        return tongtien;
    }
}

