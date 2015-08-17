package com.example.pathum.mycabpickme;

import android.app.AlertDialog;
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
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class LoginActivity extends ActionBarActivity implements View.OnClickListener {
    private EditText emailField,passwordField;

    private Button btnlog;
    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();
    private static final String LOGIN_URL = "http://unibook.byethost15.com/myCab/plogin.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        btnlog=(Button)findViewById(R.id.B_login);
        emailField = (EditText)findViewById(R.id.ET_email);
        passwordField = (EditText)findViewById(R.id.ET_Password);




        getSupportActionBar().hide();
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

    class PassengerrLogin extends AsyncTask<String, String, String> {


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

            String username = emailField.getText().toString();


            String password = passwordField.getText().toString();

            try {



                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("email", username));

                params.add(new BasicNameValuePair("password", password));

                Log.d("request!", "starting");



                JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params);



                Log.d("Login attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {

                    Log.d("Login Successful!", json.toString());
                    SharedPreferences pref = getApplicationContext().getSharedPreferences("MyPrefs", 0);
                    SharedPreferences.Editor editor = pref.edit();

                    editor.putString("email", json.getString("email"));

                    editor.commit();

                    Intent i = new Intent(LoginActivity.this, MapsActivity.class);


                    finish();

                    startActivity(i);

                    return json.getString(TAG_MESSAGE);

                }else{

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
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.B_login:
                new PassengerrLogin().execute();
                break;
            case R.id.B_registerHere:
                Intent intent = new Intent(LoginActivity.this,RegisterActivity.class);
                startActivity(intent);
                break;
        }
    }
}