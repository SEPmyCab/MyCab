package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ViewPassenger extends ActionBarActivity implements View.OnLongClickListener {
//declare variables
    String fname;
    String lname;
    String email;
    String phone;
    EditText etFname;
    EditText etLname;
    EditText etEmail;
    EditText etPhone;
    private ProgressDialog pDialog;
    Button up;
    JSONParser jsonParser = new JSONParser();
    //main url for db access
    private static final String RETRIVER_PROFILE = "http://cabeelk.com/myCab2/UserProfileRetriveData.php";


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_passenger);
        //Edit text fields
        etEmail= (EditText) findViewById(R.id.vEmail);
        etFname= (EditText) findViewById(R.id.vFname);
        etLname= (EditText) findViewById(R.id.vLname);
        etPhone= (EditText) findViewById(R.id.vPhone);
        up=(Button)findViewById(R.id.buttonUpdate);
        new fetchingData().execute();


        up.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(ViewPassenger.this, UpdateUserProfile.class);
                startActivity(i);
            }
        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_view_passenger, menu);
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

    @Override
    public boolean onLongClick(View v) {
        return false;
    }

    public class fetchingData extends AsyncTask<String,String,String> {


        @Override
        protected String doInBackground(String... args) {
            //String username="1";
            SharedPreferences mySharedPreferences ;
            mySharedPreferences=getSharedPreferences("MyPrefs",0);
            String email1= mySharedPreferences.getString("email","");
            List<NameValuePair> params=new ArrayList<>();

            params.add(new BasicNameValuePair("username",email1));

            try {

                JSONObject json=jsonParser.makeHttpRequest(RETRIVER_PROFILE,"POST",params);

                int suscess=json.getInt("sucess");
                System.out.println(suscess);
                Log.d("Register attempt", json.toString());
                //sucess is get from db status
                if(suscess==1) {

                    fname=json.getString("fname");
                    lname=json.getString("lname");
                    email=json.getString("email");
                    phone=json.getString("phoneno");

                }



            } catch (JSONException e) {
                e.printStackTrace();
                System.out.println(e);
            }


            return null;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            //start progress bar activity
            pDialog = new ProgressDialog(ViewPassenger.this);
            pDialog.setMessage("Fetching Data...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

        }

        @Override
        protected void onPostExecute(String s) {

            //stop progress bar
            super.onPostExecute(s);
            pDialog.dismiss();

            //assining values to Edit Text
            etFname.setText(fname);
            etLname.setText(lname);
            etEmail.setText(email);
            etPhone.setText(phone);

        }
    }
}
