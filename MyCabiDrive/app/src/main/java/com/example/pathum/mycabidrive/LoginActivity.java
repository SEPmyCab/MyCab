package com.example.pathum.mycabidrive;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.Settings;
import android.support.v7.app.ActionBarActivity;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.gcm.GoogleCloudMessaging;
import com.loopj.android.http.RequestParams;


public class LoginActivity extends ActionBarActivity implements View.OnClickListener {
    private EditText usernameField,passwordField;

    private Button btnlog;
    private Button forgotpassword;
    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();
    private static final String LOGIN_URL = "http://blinkcab.host56.com/myCab2/login.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";
    public static String dbuname;
    public static  String dbemail;
    public static String dbnic;
    public static String dbphone;
    public static String dbpassword;

    public LoginActivity(){}
    RequestParams params1 = new RequestParams();
    GoogleCloudMessaging gcmObj;
    Context applicationContext;
    String regId = "";
    private final static int PLAY_SERVICES_RESOLUTION_REQUEST = 9000;

    AsyncTask<Void, Void, String> createRegIdTask;

    public static final String REG_ID = "regId";
    public static final String EMAIL_ID = "emailId";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        if(isNetworkAvailable()==false)
        {
            createNetErrorDialog();

        }
        applicationContext = getApplicationContext();
        usernameField = (EditText)findViewById(R.id.ET_UserName);
        passwordField = (EditText)findViewById(R.id.ET_Password);
        forgotpassword= (Button) findViewById(R.id.B_forgotPassword);
        btnlog = (Button)findViewById(R.id.B_login);
        btnlog.setOnClickListener(this);
        getSupportActionBar().hide();

    }
    protected void createNetErrorDialog() {

        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage("You need a network connection to use this application. Please turn on mobile network or Wi-Fi in Settings.")
                .setTitle("Unable to connect")
                .setCancelable(false)
                .setPositiveButton("Settings",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                Intent i = new Intent(Settings.ACTION_WIRELESS_SETTINGS);
                                startActivity(i);
                            }
                        }
                )
                .setNegativeButton("Cancel",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                LoginActivity.this.finish();
                            }
                        }
                );
        AlertDialog alert = builder.create();
        alert.show();

    }
    private boolean isNetworkAvailable() {
        boolean haveConnectedWifi = false;
        boolean haveConnectedMobile = false;

        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo[] netInfo = cm.getAllNetworkInfo();
        for (NetworkInfo ni : netInfo) {
            if (ni.getTypeName().equalsIgnoreCase("WIFI"))
                if (ni.isConnected())
                    haveConnectedWifi = true;
            if (ni.getTypeName().equalsIgnoreCase("MOBILE"))
                if (ni.isConnected())
                    haveConnectedMobile = true;
        }
        return haveConnectedWifi || haveConnectedMobile;
    }
    class DriverLogin extends AsyncTask<String, String, String> {


        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(LoginActivity.this);
            pDialog.setMessage("Attempting login...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

            // pDialog.dismiss();
        }


        private boolean isValidPassword(String pass) {
            if (pass != null && pass.length() > 6) {
                return true;
            }
            return false;
        }
        @Override
        protected String doInBackground(String... args) {

           /*
            TODO Auto-generated method stub
            Check for success tag
            */

            int success;

            String username = usernameField.getText().toString();


            String password = passwordField.getText().toString();
            String msg = "";
            try {
                if (gcmObj == null) {
                    gcmObj = GoogleCloudMessaging
                            .getInstance(applicationContext);
                }
                regId = gcmObj.register(ApplicationConstants.GOOGLE_PROJ_ID);
                msg = "Registration ID :" + regId;

            } catch (IOException ex) {
                msg = "Error :" + ex.getMessage();
            }
            try {



                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("username", username));

                params.add(new BasicNameValuePair("password", password));
                params.add(new BasicNameValuePair("regId",regId));
                Log.d("request!", "starting");



                JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params);



                Log.d("Login attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {
                    dbuname=json.getString("uname");
                    dbemail=json.getString("email");
                    dbnic=json.getString("nic");
                    dbphone=json.getString("phone");
                    Log.d("Login Successful!", json.toString());
                    SharedPreferences pref = getApplicationContext().getSharedPreferences("MyPref", 0);
                    SharedPreferences.Editor editor = pref.edit();

                    editor.putString("uname", dbuname);
                    editor.putString("nic",dbnic);
                    editor.commit();


                    Intent i = new Intent(LoginActivity.this, MainActivity.class);


                    //i.putExtra("User Name",dbuname);
                    finish();

                    //get user id to Availableity activity
                    i.putExtra("userID",dbuname);

                    startActivity(i);

                    return json.getString(TAG_MESSAGE);

                }else if (success == 0){

                    Log.d("Login Failure!", json.getString(TAG_MESSAGE));

                    try{
                    dbphone=json.getString("phone");
                    dbpassword=json.getString("password");
                    }catch (Exception e){

                    }

                   // Toast.makeText(getApplicationContext(),"Invalid Credentials ..!",Toast.LENGTH_LONG).show();


                }else
                {
                    Log.d("Login Failure!", json.getString(TAG_MESSAGE));

                    return json.getString(TAG_MESSAGE);
                }

            } catch (JSONException e) {

                e.printStackTrace();

            }

            return null;

        }

        @Override
        protected void onPostExecute(String file_url){

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(LoginActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_login, menu);
        return true;
    }





    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(android.R.drawable.ic_dialog_alert)
                .setTitle("EXIT")
                .setMessage("Are you sure you want to Exit?")
                .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }

                })
                .setNegativeButton("No", null)
                .show();
    }

    @Override
    public void onClick(View v) {
switch(v.getId())
        {
            case R.id.B_registerHere:
                Intent intent = new Intent(LoginActivity.this,RegisterActivity.class);
                startActivity(intent);
                break;
            case R.id.B_login:
               // String username = usernameField.getText().toString();
              //  String password = passwordField.getText().toString();

                new DriverLogin().execute();
                break;
            case R.id.B_forgotPassword:
                String uName=usernameField.getText().toString();
                if (uName.isEmpty()){
                    Toast.makeText(getApplicationContext(),"Please Enter User Name .",Toast.LENGTH_LONG).show();
                }else {
                    new DriverLogin().execute();
                    new AlertDialog.Builder(this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("Forgot Password")
                            .setMessage("Password will Automaticalle send to your mobile number Do you agree with it ?")
                            .setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    try {
                                        SmsManager smsManager = SmsManager.getDefault();
                                        smsManager.sendTextMessage(dbphone, null, "Your MyCabIdrive Password is : " + dbpassword, null, null);
                                    } catch (Exception e) {
                                        System.out.println(e);
                                    }

                                    finish();
                                }

                            })
                            .setNegativeButton("No", null)
                            .show();
                }
        }

    }


}
