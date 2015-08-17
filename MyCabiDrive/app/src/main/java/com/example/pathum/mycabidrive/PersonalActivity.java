package com.example.pathum.mycabidrive;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.ContentValues;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.AsyncTask;
import android.provider.MediaStore;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;


public class PersonalActivity extends ActionBarActivity implements View.OnClickListener {
    EditText UN;
    EditText NIC;
    EditText Phone;
    EditText Email;

    String U_Name;
    String E_mail;
    String N_IC;
    String P_hone;
    private ProgressDialog pDialog;



    JSONParser jsonParser = new JSONParser();
    private static final String FETCH_DRIVER_URL = "http://unibook.byethost15.com/myCab/fetch_driver.php";
    private static final String SAVE_DRIVER_URL = "http://unibook.byethost15.com/myCab/save_driver.php";
    private static final String TAG_SUCCESS1 = "success";
    private static final String TAG_MESSAGE1 = "message";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";


    private static final int PICK_IMAGE = 1;
    private static final int PICK_Camera_IMAGE = 2;
    private ImageView imgView;
    private Button upload,cancel;
    private Bitmap bitmap;
    private ProgressDialog dialog;
    Uri imageUri;
    String mString;
    MediaPlayer mp=new MediaPlayer();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_personal);
        getSupportActionBar().hide();
        UN=(EditText)findViewById(R.id.ET_Username);
        NIC=(EditText)findViewById(R.id.ET_nic);
        Phone=(EditText)findViewById(R.id.ET_phone);
        Email=(EditText)findViewById(R.id.ET_Email);

        new GetDriver().execute();

        //imgView = (ImageView) findViewById(R.id.ImageView);
        //upload = (Button) findViewById(R.id.imguploadbtn);
        //cancel = (Button) findViewById(R.id.imgcancelbtn);

        SharedPreferences mySharedPreferences ;
        mySharedPreferences=getSharedPreferences("MyPref",0);
        mString= mySharedPreferences.getString("user_name","");



    }

    @Override
    public void onClick(View v) {
        switch(v.getId())
        {

            case R.id.B_savePersonal:
                // String username = usernameField.getText().toString();
                //  String password = passwordField.getText().toString();

                new SaveDriver().execute();
                break;


        }
    }

    class GetDriver extends AsyncTask<String, String, String> {


        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(PersonalActivity.this);
            pDialog.setMessage("Fetching Driver Details...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

            // pDialog.dismiss();
        }


        @Override
        protected String doInBackground(String... args) {

           /*
            TODO Auto-generated method stub
            Check for success tag
            */

            int success;



            try {



                List<NameValuePair> params = new ArrayList<NameValuePair>();


                params.add(new BasicNameValuePair("username",mString));



                Log.d("request!", "starting");


                JSONObject json = jsonParser.makeHttpRequest(FETCH_DRIVER_URL, "POST", params);



                Log.d("Fetch attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {

                    U_Name=json.getString("uname");
                    N_IC=json.getString("nic");
                    P_hone=json.getString("phone");
                    E_mail=json.getString("email");
                    this.publishProgress(U_Name,N_IC,P_hone,E_mail);
                    Log.d("Driver Recieved!", json.toString());

                   //finish();
                    return json.getString(TAG_MESSAGE);

                }else{

                    Log.d("Error!", json.getString(TAG_MESSAGE));

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
                Toast.makeText(PersonalActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
        @Override
        protected void onProgressUpdate(String... values) {
            super.onProgressUpdate(values);
            UN.setText(values[0]);
            NIC.setText(values[1]);
            Phone.setText(values[2]);
            Email.setText(values[3]);
        }
    }

    class SaveDriver extends AsyncTask<String, String, String> {
        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(PersonalActivity.this);
            pDialog.setMessage("Saving Changes...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        protected String doInBackground(String... arg0) {

            int success;


            String Uname = UN.getText().toString();
            String nic = NIC.getText().toString();
            String phone=Phone.getText().toString();
            String email = Email.getText().toString();




                try {
                    List<NameValuePair> params = new ArrayList<NameValuePair>();

                    params.add(new BasicNameValuePair("uname", mString));
                    params.add(new BasicNameValuePair("nic", nic));
                    params.add(new BasicNameValuePair("phone", phone));
                    params.add(new BasicNameValuePair("email", email));

                    Log.d("request!", "starting");

                    JSONObject json1 = jsonParser.makeHttpRequest(SAVE_DRIVER_URL, "POST", params);

                    Log.d("Save attempt", json1.toString());

                    success = json1.getInt(TAG_SUCCESS1);
                    if (success == 1) {
                        Log.d("Changed are Saved!", json1.toString());
                        Intent intent = new Intent(PersonalActivity.this, MainActivity.class);
                       // intent.putExtra("User Name",mString);
                        finish();
                        startActivity(intent);
                        return json1.getString(TAG_MESSAGE1);


                    } else {
                        Log.d("Cannot Save Changes!", json1.getString(TAG_MESSAGE1));
                        return json1.getString(TAG_MESSAGE1);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(PersonalActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_set_availability, menu);
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.options_menu, menu);
       // return true;

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
