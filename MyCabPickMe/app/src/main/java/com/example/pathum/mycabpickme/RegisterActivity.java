package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class RegisterActivity extends ActionBarActivity implements View.OnClickListener  {
   // JSONParser jsonParser = new JSONParser();
    private ProgressDialog pDialog;


    EditText fnameField;
    EditText lnameField;

    EditText passwordField;
    EditText conpwdField;
EditText emailField;
    EditText phoneField;


    Button btnreg;
    JSONParser jsonParser = new JSONParser();
    private static final String LOGIN_URL = "http://blinkcab.host56.com/myCab2/pregister.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_register);
        getSupportActionBar().hide();

        fnameField = (EditText) findViewById(R.id.ET_FirstName);
        lnameField = (EditText) findViewById(R.id.ET_LastName);
emailField=(EditText)findViewById(R.id.ET_email);
        passwordField = (EditText) findViewById(R.id.ET_Password);
        conpwdField=(EditText)findViewById(R.id.ET_ConPassword);

        phoneField = (EditText) findViewById(R.id.ET_PhoneNo);


        btnreg = (Button) findViewById(R.id.B_register);
        btnreg.setOnClickListener(this);



    }

    @Override
    public void onClick(View v) {
        switch(v.getId())
        {

            case R.id.B_register:


                new CreateNewPassenger().execute();
                break;
        }
    }


    class CreateNewPassenger extends AsyncTask<String, String, String> {
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
            String Email=emailField.getText().toString();
            String Pwd = passwordField.getText().toString();
            String cPwd=conpwdField.getText().toString();

            String Phone="";
                    Phone=phoneField.getText().toString();





                try {
                    List<NameValuePair> params = new ArrayList<NameValuePair>();
                    params.add(new BasicNameValuePair("fname", Fname));
                    params.add(new BasicNameValuePair("lname", Lname));
                    params.add(new BasicNameValuePair("email",Email));
                    params.add(new BasicNameValuePair("password", Pwd));

                    params.add(new BasicNameValuePair("phone", Phone));

                    params.add(new BasicNameValuePair("cpwd", cPwd));
                    Log.d("request!", "starting");

                    JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params);

                    Log.d("Register attempt", json.toString());

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
