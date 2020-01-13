package com.linh.mycoffeemng.util;




import android.annotation.SuppressLint;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.util.Log;

import org.apache.http.client.params.HttpClientParams;
import org.apache.http.conn.ClientConnectionManager;
import org.apache.http.conn.ConnectTimeoutException;
import org.apache.http.conn.scheme.LayeredSocketFactory;
import org.apache.http.conn.scheme.PlainSocketFactory;
import org.apache.http.conn.scheme.Scheme;
import org.apache.http.conn.scheme.SchemeRegistry;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.impl.conn.tsccm.ThreadSafeClientConnManager;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;

import java.io.IOException;
import java.net.InetAddress;
import java.net.InetSocketAddress;
import java.net.Socket;
import java.net.UnknownHostException;
import java.security.KeyManagementException;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.security.cert.CertificateException;
import java.security.cert.X509Certificate;

import javax.net.ssl.SSLContext;
import javax.net.ssl.SSLEngine;
import javax.net.ssl.SSLSocket;
import javax.net.ssl.TrustManager;
import javax.net.ssl.X509ExtendedTrustManager;


public class HttpClient {
    private HttpParams getHttpParams(){
        HttpParams http = new BasicHttpParams();
        HttpClientParams.setRedirecting(http,true);

        HttpConnectionParams.setConnectionTimeout(http, 3000);
        HttpConnectionParams.setSoTimeout(http, 3000);

        return http;
    }
    @RequiresApi(api = Build.VERSION_CODES.N)
    public DefaultHttpClient Client(){
        SchemeRegistry sSupportedSchemes = new SchemeRegistry();

        sSupportedSchemes.register(new Scheme("http", PlainSocketFactory.getSocketFactory(),80));

        sSupportedSchemes.register(new Scheme("https", TrustAllSSLSocketFactory.getSocketFactory(), 443));

        ClientConnectionManager ccm = new ThreadSafeClientConnManager(getHttpParams(),sSupportedSchemes);

        DefaultHttpClient httpclient = new DefaultHttpClient(ccm, getHttpParams());

        return httpclient;
    }
    @RequiresApi(api = Build.VERSION_CODES.N)
    private static final class TrustAllSSLSocketFactory implements LayeredSocketFactory {
        private static final TrustAllSSLSocketFactory DEFAULT_FACTORY = new TrustAllSSLSocketFactory();
        public static TrustAllSSLSocketFactory getSocketFactory(){return DEFAULT_FACTORY;}

        private SSLContext sslContext;
        private javax.net.ssl.SSLSocketFactory socketFactory;

        @RequiresApi(api = Build.VERSION_CODES.N)
        @SuppressLint("TrulyRandom")
        private TrustAllSSLSocketFactory(){
            super();
            TrustManager[] tm = new TrustManager[] {new X509ExtendedTrustManager() {
                @Override
                public void checkClientTrusted(X509Certificate[] chain, String authType, Socket socket) throws CertificateException {

                }

                @Override
                public void checkServerTrusted(X509Certificate[] chain, String authType, Socket socket) throws CertificateException {

                }

                @Override
                public void checkClientTrusted(X509Certificate[] chain, String authType, SSLEngine engine) throws CertificateException {

                }

                @Override
                public void checkServerTrusted(X509Certificate[] chain, String authType, SSLEngine engine) throws CertificateException {

                }

                @Override
                public void checkClientTrusted(X509Certificate[] chain, String authType) throws CertificateException {

                }

                @Override
                public void checkServerTrusted(X509Certificate[] chain, String authType) throws CertificateException {

                }

                @Override
                public X509Certificate[] getAcceptedIssuers() {
                    return new X509Certificate[0];
                }
            }};
            try {
                this.sslContext = SSLContext.getInstance("TLS");
                this.sslContext.init(null, tm, new SecureRandom());
                this.socketFactory = this.sslContext.getSocketFactory();
            } catch (NoSuchAlgorithmException e) {
                Log.e("Failed", "Failed to instantiate TrustAllSSLSocketFactory!", e);
            } catch (KeyManagementException e) {
                Log.e("Failed", "Failed to instantiate TrustAllSSLSocketFactory!", e);
            }
        }

        @Override
        public Socket createSocket(Socket socket, String host, int port, boolean autoClose) throws IOException, UnknownHostException {
            SSLSocket sslSocket = (SSLSocket) this.socketFactory.createSocket(socket, host,port,autoClose);
            return sslSocket;
        }

        @Override
        public Socket createSocket() throws IOException {
            return (SSLSocket) this.socketFactory.createSocket();
        }

        @Override
        public Socket connectSocket(Socket sock, String host, int port, InetAddress localAddress, int localPort, HttpParams params) throws ConnectTimeoutException, IOException, UnknownHostException {
            if(host == null){
                throw new IllegalArgumentException("Target host may not be null.");
            }
            if (params == null){
                throw new IllegalArgumentException("Parameters may not be null.");
            }

            SSLSocket sslSock = (SSLSocket) ((sock!=null) ? sock : createSocket());
            if ((localAddress != null) || (localPort > 0)){
                if (localPort < 0){
                    localPort = 0;
                }
                InetSocketAddress isa = new InetSocketAddress(localAddress, localPort);
                sslSock.bind(isa);
            }
            int connTimeout = HttpConnectionParams.getConnectionTimeout(params);
            int soTimeout = HttpConnectionParams.getSoTimeout(params);

            InetSocketAddress remoteAddress;
            remoteAddress = new InetSocketAddress(host,port);

            sslSock.connect(remoteAddress,connTimeout);

            sslSock.setSoTimeout(soTimeout);

            return sslSock;
        }

        @Override
        public boolean isSecure(Socket sock) throws IllegalArgumentException {
            return true;
        }
    }
}
