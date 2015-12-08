package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.util.Patterns;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;

import com.example.pathum.mycabpickme.validation.updateUserProfile_Validation;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;


public class UpdateUserProfile extends ActionBarActivity implements View.OnClickListener {
    private ProgressDialog pDialog;


    EditText ufname;
    EditText ulname;
    EditText uphoneno;
    EditText uemail;
    EditText password;
    EditText conPassword;
    Button update;
    String fname;
    String lname;
    //String email;
    String phone;
    String upassword;
    String uconPassword;
    int Status;
    String Message;

    String progressBarFetchingDataMsg="Fetching data...";
    String progressBarReceivingDataMsg ="Receiving data...";
    List<NameValuePair> args=new ArrayList<NameValuePair>();

    /*
     webservics access object
     methods : makeHttpRequest
         : getJSONFromUrl
    */
    JSONParser jsonParser = new JSONParser();

    /**
     * Methods  getSupportActionBar().hide();
     * Methods  declareVariables
     * Methods  fetchingD0ata().execute()
     * @param savedInstanceState
     */

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_user_profile);
        getSupportActionBar().hide();
        declareVariables();
        new fetchingData().execute();

    }

    /**
     * class variables declare in here
     * @return 1 for successful -1 for else
     * @exception NullPointerException
     * @exception NumberFormatException
     * @exception Exception handle any exception
     */
    public int declareVariables(){

        try {

            ufname = (EditText) findViewById(R.id.vFname);
            ulname = (EditText) findViewById(R.id.vLname);
           // uemail = (EditText) findViewById(R.id.vEmail);
            uphoneno = (EditText) findViewById(R.id.vPhone);
            password=(EditText)findViewById(R.id.updatePassword);
            conPassword= (EditText) findViewById(R.id.confirmPassword);
            update = (Button) findViewById(R.id.btn_Update);
            return 1;

        }catch(NullPointerException nullpointexception){

            Log.e("declaring Error", "Error converting result " + nullpointexception.toString());

        }catch(NumberFormatException numberformatexception){

            Log.e("declaring Error", "Error converting result " + numberformatexception.toString());

        }catch(Exception exception){

            Log.e("declaring Error", "Error converting result " + exception.toString());

        }finally {

            Log.e("declaring finall", "declaring finall ");

        }
        return -1;
    }

    /**
     * AsyncTask fetching data
     * Methods doInBackground
     * Methods onPreExecute
     * Methods onPostExecute
     */
    public class fetchingData extends AsyncTask<String,String,String>{

        /**
         *
         * @param args
         * @return
         *
         */
        @Override
        protected String doInBackground(String... args) {
           // String username="1";
            SharedPreferences mySharedPreferences ;
            mySharedPreferences=getSharedPreferences("MyPrefs",0);
            String email1= mySharedPreferences.getString("email","");
            List<NameValuePair>params=new ArrayList<NameValuePair>();

            params.add(new BasicNameValuePair("username",email1));
            try {

            JSONObject json=jsonParser.makeHttpRequest(properties.RETRIVER_PROFILE,"POST",params);

                Log.d("Register attempt", json.toString());
                if(json.getInt("sucess")==1) {

                    fname=json.getString("fname");
                    lname=json.getString("lname");
                    //email=json.getString("email");
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
            progressBar(true, progressBarFetchingDataMsg);

        }

        @Override
        protected void onPostExecute(String s) {

            super.onPostExecute(s);
            progressBar(false, progressBarFetchingDataMsg);
            fetchData(fname, lname, phone);

        }
    }

    /**
     * progress bar activity controller method
     * @param Controller start stop progress bar
     * @param message message for preview
     */
    public void progressBar(boolean Controller,String message){

        try {
            if (Controller) {
                pDialog = new ProgressDialog(UpdateUserProfile.this);
                pDialog.setMessage(message);
                pDialog.setIndeterminate(false);
                pDialog.setCancelable(true);
                pDialog.show();
            } else if (!Controller) {
                pDialog.dismiss();
            }
        }catch (NullPointerException nullpointerexception){

            Log.e("ProgressBar Error", "Error converting result " + nullpointerexception.toString());

        }catch (Exception exception){

            Log.e("ProgressBar Error", "Error converting result " + exception.toString());

        }finally {

        }

    }

    /**
     * fetch retrive data to text boxes
     * @param fname user first name
     * @param lname user last name

     * @param phone user phone number
     * @exception NullPointerException
     */
    public void fetchData(String fname,String lname,String phone){

        try {

            ufname.setText(fname);
            ulname.setText(lname);
            //uemail.setText(email);
            uphoneno.setText(phone);

        }catch (NullPointerException nullpointexception){

        }finally {

        }

    }


    public class updateUserProfile extends AsyncTask<String,String,String>{

        /**
         * background thread
         * @param params
         * @return
         */
        @Override
        protected String doInBackground(String... params) {


            /*
             *here user name get from home page
             * pathum watch here
             */
            String username="1";

                 args.add(new BasicNameValuePair("fname", fname));
                 args.add(new BasicNameValuePair("lname", lname));
                // args.add(new BasicNameValuePair("email", email));
                 args.add(new BasicNameValuePair("phone", phone));
                 args.add(new BasicNameValuePair("uname",username));

                 JSONObject jsonobject=jsonParser.makeHttpRequest(properties.UPDATE_PROFILE_URL, "POST", args);

                 try {
                     Status = jsonobject.getInt("sucess");
                     Message=jsonobject.get("message").toString();

                 }catch (JSONException e){

                     System.out.println("JSONE Error : "+e);

                 }catch (NullPointerException nullpointerexception){

                 }catch(Exception exception){

                 } finally {

                 }

            return null;
        }

        @Override
        protected void onPreExecute() {

                super.onPreExecute();
                super.onPreExecute();
                pDialog = new ProgressDialog(UpdateUserProfile.this);
                pDialog.setMessage("Fetching Data...");
                pDialog.setIndeterminate(false);
                pDialog.setCancelable(true);
                pDialog.show();

        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pDialog.dismiss();
            if (Status==1){

                Toast.makeText(getApplicationContext(),"Successfully Updated ....",Toast.LENGTH_LONG).show();

            }else if(Status==0){

                Toast.makeText(getApplicationContext(),"Updating Error ..",Toast.LENGTH_LONG).show();

            }


        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_update_user_profile, menu);
        return true;
    }

    /**
     *
     * @param item
     * @return
     */
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
    public boolean validate(){

        boolean validation=true;

        try {

            fname = ufname.getText().toString();
            lname = ulname.getText().toString();
           // email = uemail.getText().toString();
            phone = uphoneno.getText().toString();


            upassword = password.getText().toString();
            uconPassword = conPassword.getText().toString();
            updateUserProfile_Validation updateuserprofile_validation = new updateUserProfile_Validation();


            //if there are any validation method got fail then validation boolean value is got fail then update part will stop
            if(!updateuserprofile_validation.nameValidator(fname, lname)){

                validation=false;
                ufname.setBackgroundColor(Color.RED);
                ulname.setBackgroundColor(Color.RED);
                Toast.makeText(getApplicationContext(),"Invalid characters in user name  .. ",Toast.LENGTH_LONG).show();

            }if(!updateuserprofile_validation.phoneNumberValidator(phone)){

                validation=false;
                uphoneno.setBackgroundColor(Color.RED);
                Toast.makeText(getApplicationContext(),"Invalid phone number .. ",Toast.LENGTH_LONG).show();

            }

        }catch (NullPointerException nullpointexception){

        }catch (Exception exception){

        }finally {

        }
        if(validation){

            ufname.setBackgroundColor(Color.WHITE);
            ulname.setBackgroundColor(Color.WHITE);
            uemail.setBackgroundColor(Color.WHITE);
            uphoneno.setBackgroundColor(Color.WHITE);

        }

        return validation;

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.btn_Update:

                if(validate()) {

                    //update user profile Background thread start
                    new updateUserProfile().execute();

                }
                    break;
        }

    }
}
