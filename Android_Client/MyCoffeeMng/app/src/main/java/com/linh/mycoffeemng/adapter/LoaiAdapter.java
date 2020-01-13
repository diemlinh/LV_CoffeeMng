package com.linh.mycoffeemng.adapter;

import android.content.Context;
import android.support.v7.widget.CardView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.linh.mycoffeemng.R;
import com.linh.mycoffeemng.model.Loaisanpham;

import java.util.ArrayList;

public class LoaiAdapter extends BaseAdapter {

    Context context;
    ArrayList<Loaisanpham> arrayLoai;
    ViewHolderLoaiMonAn viewHolderLoaiMonAn;

    public LoaiAdapter(Context context, ArrayList<Loaisanpham> arrayLoai) {
        this.context = context;
        this.arrayLoai = arrayLoai;
    }

    @Override
    public int getCount() {
        return arrayLoai.size();
    }

    @Override
    public Object getItem(int position) {
        return arrayLoai.get(position);
    }

    @Override
    public long getItemId(int position) {
        return arrayLoai.get(position).getMaloai();
    }


    public class ViewHolderLoaiMonAn{
        TextView txtTenLoai;
        CardView cardView;
    }
    @Override
    public View getDropDownView(int position, View convertView, ViewGroup parent) {
        View view = convertView;
        ViewHolderLoaiMonAn viewHolderLoaiMonAn;
        if (view == null){
            viewHolderLoaiMonAn = new ViewHolderLoaiMonAn();
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.custom_layout_spinloaisanpham, parent, false);

            viewHolderLoaiMonAn.txtTenLoai = (TextView) view.findViewById(R.id.txtTenloai);
//            viewHolderLoaiMonAn.cardView = (CardView) view.findViewById(R.id.cardViewloai);

            view.setTag(viewHolderLoaiMonAn);
        }
        else {
            viewHolderLoaiMonAn = (ViewHolderLoaiMonAn) view.getTag();
        }

        Loaisanpham loaisanpham = (Loaisanpham) getItem(position);
        int maloai = (int) getItemId(position);
        viewHolderLoaiMonAn.txtTenLoai.setText(loaisanpham.getTenloai());
        viewHolderLoaiMonAn.txtTenLoai.setTag(loaisanpham.getTenloai());

        return view;
    }
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View view = convertView;
        ViewHolderLoaiMonAn viewHolderLoaiMonAn;
        if (view == null){
            viewHolderLoaiMonAn = new ViewHolderLoaiMonAn();
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.custom_layout_spinloaisanpham, parent, false);

            viewHolderLoaiMonAn.txtTenLoai = (TextView) view.findViewById(R.id.txtTenloai);

            view.setTag(viewHolderLoaiMonAn);
        }
        else {
            viewHolderLoaiMonAn = (ViewHolderLoaiMonAn) view.getTag();
        }

        Loaisanpham loaisanpham = (Loaisanpham) getItem(position);
        int maloai = (int) getItemId(position);
        viewHolderLoaiMonAn.txtTenLoai.setText(loaisanpham.getTenloai());
        viewHolderLoaiMonAn.txtTenLoai.setTag(loaisanpham.getTenloai());


        return view;
    }
}
