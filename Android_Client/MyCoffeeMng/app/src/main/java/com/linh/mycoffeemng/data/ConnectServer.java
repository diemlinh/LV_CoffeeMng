package com.linh.mycoffeemng.data;
import android.content.Context;
import android.support.annotation.NonNull;
import android.util.Log;

import com.linh.mycoffeemng.util.Server;

import java.io.IOException;

import okhttp3.Interceptor;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.linh.mycoffeemng.util.Server.TOKEN;

public class ConnectServer {
        private static Retrofit retrofit = null;
//
//    private static OkHttpClient client = new OkHttpClient().newBuilder().addInterceptor(new Interceptor() {
//        @Override
//        public Response intercept(@NonNull Chain chain) throws IOException {
//            Request request = chain.request()
//                    .newBuilder()
//                    .addHeader("token", TOKEN)
//                    .build();
//            return chain.proceed(request);
//        }
//    }).build();
//        OkHttpClient.Builder httpClient = new OkHttpClient.Builder();
//        httpClient.add(new Interceptor() {
//                @Override
//                public Response intercept(Chain chain) throws IOException {
//                        Request request = chain.request().newBuilder().addHeader("parameter", "value").build();
//                        return chain.proceed(request);
//                }
//        });
        public static Retrofit getClient(String baseUrl) {
                if (retrofit==null) {
                        retrofit = new Retrofit.Builder()
//                                .client(client)
                                .baseUrl(baseUrl)
                                .addConverterFactory(GsonConverterFactory.create())
                                .build();
                }
                return retrofit;
        }
//        public static ConnectServer getInstance(Context context) {
//
//                if (mConnectServer == null) {
//                        Log.e("SV", "getInstance: new ConnectServer "  );
//                        mConnectServer = new ConnectServer(context);
//                }
//                return mConnectServer;
//        }
//
//        public static void destroy() {
//                mConnectServer = null;
//                Log.e("SV", "Destroy ConnectServer "  );
//        }
//
//        public API getApi() {
//                return api;
//        }
}
