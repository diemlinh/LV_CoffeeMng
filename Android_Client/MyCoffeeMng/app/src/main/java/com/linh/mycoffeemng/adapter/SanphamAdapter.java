package com.linh.mycoffeemng.adapter;

import android.content.Context;
import android.graphics.Color;
import android.icu.text.DecimalFormat;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.model.Chitiethoadon;
import com.linh.mycoffeemng.model.Sanpham;
import com.linh.mycoffeemng.util.Server;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

public class SanphamAdapter extends RecyclerView.Adapter<SanphamAdapter.ShowHolder> {

    private List<Sanpham> mangSanpham;
    private Context context;
    BanAdapter.ShowHolder showHolder;

    class ShowHolder extends RecyclerView.ViewHolder{
        View itemView;
        CardView cardViewSp;
        TextView tvtensanpham, tvgia;
        Button btnGhichu;
        ImageView imSanpham;
        public ShowHolder(final View itemView) {
            super(itemView);

            cardViewSp = (CardView) itemView.findViewById(R.id.cardViewSp);
            tvtensanpham = (TextView) itemView.findViewById(R.id.tvtensanpham);
            btnGhichu = (Button) itemView.findViewById(R.id.btnGhichu);
            tvgia = (TextView) itemView.findViewById(R.id.tvgia);
            imSanpham = (ImageView) itemView.findViewById(R.id.imSanpham);
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

    public SanphamAdapter(List<Sanpham> mangsanpham, Context context) {
        this.mangSanpham = mangsanpham;
        this.context = context;
    }

    @Override
    public SanphamAdapter.ShowHolder onCreateViewHolder(ViewGroup viewGroup, int position) {

        View view = LayoutInflater.from(viewGroup.getContext())
                .inflate(R.layout.custom_layout_sanpham, viewGroup, false);
        SanphamAdapter.ShowHolder showHolder= new SanphamAdapter.ShowHolder(view);
        return showHolder;
    }

    @Override
    public void onBindViewHolder(SanphamAdapter.ShowHolder showHolder, final int position) {
        final Sanpham sanpham = mangSanpham.get(position);
        showHolder.tvtensanpham.setText(sanpham.getTensp());
        showHolder.tvgia.setText(sanpham.getDongia().toString());
        Picasso.get().load(Server.URL_SERVER + "upload/" + sanpham.getHinhanh()).fit().into(showHolder.imSanpham);
        showHolder.cardViewSp.setTag(position);
        final int masp = mangSanpham.get(position).getMasp();

//        showHolder.cardViewSp.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
////              ArrayList<Chitiethoadon> chitiethoadon = new ArrayList<>();
////                for (int i=0; i<chitiethoadon.size(); i++){
////                    Chitiethoadon chitiet = chitiethoadon.get(i);
////                    if(masp == chitiet.getMasp()){
////                        chitiet.setSoluong(chitiet.getSoluong()+1);
////                        chitiet.setThanhtien(chitiet.getDongia()*chitiet.getSoluong());
////                    }
//////                   Chitiethoadon giohang = new Chitiethoadon(null, masp, 1, sanpham.getDongia(), sanpham.getDongia(), "dang cho pha", null, "sanpham.getTensp()");
////
////
////                }
//                if (onItemClickListener != null)
//                    listener.onItemClick(itemView, getLayoutPosition());
//                onItemClickListener.onItemClick(itemv, position);
//                Toast.makeText(v.getContext(),
//                        " Demo function"+ masp, Toast.LENGTH_SHORT)
//                        .show();
//            }
//        });
    }
    public interface ItemClickListener {
        void onItemClick(View view, int position);
    }
    private ItemClickListener onItemClickListener;
    public void setItemClickListener(ItemClickListener clickListener) {
        onItemClickListener = clickListener;
    }
    @Override
    public int getItemCount() {
        return mangSanpham.size();
    }
}
