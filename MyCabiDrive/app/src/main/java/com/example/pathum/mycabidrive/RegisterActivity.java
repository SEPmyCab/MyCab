package com.example.pathum.mycabidrive;

import android.app.ProgressDialog;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


public class RegisterActivity extends ActionBarActivity implements View.OnClickListener  {
   // JSONParser jsonParser = new JSONParser();
    private ProgressDialog pDialog;


    EditText fnameField;
    EditText lnameField;
    EditText unameField;
    EditText passwordField;
    EditText conpwdField;
    EditText nicField;
    EditText phoneField;
    EditText regnoField;
  Spinner typeField;

    Button btnreg;
    JSONParser jsonParser = new JSONParser();
    private static final String LOGIN_URL = "http://cabeelk.com/myCab2/register.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";

   // private static String url_new_user = "http://mysql9.000webhost.com/public_html/DBControl/new_driver.php";


    //private static final String TAG_SUCCESS = "success";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_register);
        getSupportActionBar().hide();

        fnameField = (EditText) findViewById(R.id.ET_FirstName);
        lnameField = (EditText) findViewById(R.id.ET_LastName);
        unameField = (EditText) findViewById(R.id.ET_UserName);
        passwordField = (EditText) findViewById(R.id.ET_Password);
        conpwdField=(EditText)findViewById(R.id.ET_ConPassword);
        nicField = (EditText) findViewById(R.id.ET_NIC);
        phoneField = (EditText) findViewById(R.id.ET_PhoneNo);
        regnoField=(EditText)findViewById(R.id.ET_RegNo);
        typeField = (Spinner) findViewById(R.id.SP_vehicleType);

        btnreg = (Button) findViewById(R.id.B_register);
        btnreg.setOnClickListener(this);

        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(RegisterActivity.this,R.array.vehicle_array, android.R.layout.simple_spinner_item);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        typeField.setAdapter(adapter);
        // button click event

    }

    @Override
    public void onClick(View v) {
        switch(v.getId())
        {

            case R.id.B_register:
              /*  String Fname = fnameField.getText().toString();
                String Lname = lnameField.getText().toString();
                String Uname = unameField.getText().toString();
                String Pwd = passwordField.getText().toString();
                String NIC = nicField.getText().toString();
                String Phone=phoneField.getText().toString();
                String Regno = regnoField.getText().toString();
                String Type=typeField.getSelectedItem().toString();
*/

                new CreateNewDriver().execute();
                break;
        }
    }


    class CreateNewDriver extends AsyncTask<String, String, String> {
        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(RegisterActivity.this);
            pDialog.setMessage("Registering Driver...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        protected String doInBackground(String... arg0) {

            int success;

            String Fname = fnameField.getText().toString();
            String Lname = lnameField.getText().toString();
            String Uname = unameField.getText().toString();
            String Pwd = passwordField.getText().toString();
            String cPwd=conpwdField.getText().toString();
            String NIC = nicField.getText().toString();
            String Phone=phoneField.getText().toString();
            String Regno = regnoField.getText().toString();
            //String Type = "car";
            String Type=typeField.getSelectedItem().toString();

            //if (Pwd==cPwd & Phone.length()==12 & NIC.length()==10) {

                try {
                    List<NameValuePair> params = new ArrayList<NameValuePair>();
                    params.add(new BasicNameValuePair("fname", Fname));
                    params.add(new BasicNameValuePair("lname", Lname));
                    params.add(new BasicNameValuePair("uname", Uname));
                    params.add(new BasicNameValuePair("password", Pwd));
                    params.add(new BasicNameValuePair("nic", NIC));
                    params.add(new BasicNameValuePair("phone", Phone));
                    params.add(new BasicNameValuePair("regno", Regno));
                    params.add(new BasicNameValuePair("type", Type));
                    params.add(new BasicNameValuePair("cpwd", cPwd));
                    Log.d("request!", "starting");

                    JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params);

                    Log.d("Login attempt", json.toString());

                    success = json.getInt(TAG_SUCCESS);
                    if (success == 1) {
                        Log.d("Driver Created!", json.toString());
                        finish();
                        return json.getString(TAG_MESSAGE);
                    } else {
                        Log.d("Registration Failure!", json.getString(TAG_MESSAGE));
                        return json.getString(TAG_MESSAGE);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
           // }
           /* else{
                String error="";
                if(Pwd!=cPwd) {
                   // conpwdField.setError("Password does not match!");
                    error ="Password does not match!";
                }
                else if(Phone.length()!=12) {
                   // phoneField.setError("Invalid Phone Number");
                    error = "Invalid Phone Number!";
                }
                    else if(NIC.length()!=10) {
                   // nicField.setError("Invalid NIC");
                    error = "Invalid NIC!";
                }

                this.publishProgress(error);
            }*/
        return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(RegisterActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
        @Override
        protected void onProgressUpdate(String... values) {
            super.onProgressUpdate(values);
           /* if(values[0]=="Password does not match!") {
                 conpwdField.setError(values[0]);

            }
            else if(values[0]=="Invalid Phone Number!") {
                 phoneField.setError(values[0]);

            }
            else if(values[0]=="Invalid NIC!") {
                 nicField.setError(values[0]);

            }
            */
        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_activity_register, menu);
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


}
