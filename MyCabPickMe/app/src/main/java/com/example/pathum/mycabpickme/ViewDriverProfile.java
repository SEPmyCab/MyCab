package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.content.ActivityNotFoundException;
import android.content.Intent;
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
import android.net.Uri;


import com.example.pathum.mycabpickme.validation.Report;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class ViewDriverProfile extends ActionBarActivity implements View.OnClickListener{

    //declare variables
    private ProgressDialog pDialog;
    EditText dName;
    EditText dVehical;
    EditText dStatus;
    EditText dPhoneNo;
    Button dCall;
    String name;
    String phone;
    String certification;
    String Type;
    //main url for db access
    String FETCH_DRIVE_DETAILS_URL="http://cabeelk.com/myCab2/fetchDriverDetails.php";
    //make json object to access http methodes
    JSONParser jsonParser=new JSONParser();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_view_driver_profile);

        //Edit Text Decler
        dName= (EditText) findViewById(R.id.driverName);
        dVehical= (EditText) findViewById(R.id.driverVehical);
        dStatus= (EditText) findViewById(R.id.driverStatus);
        dPhoneNo= (EditText) findViewById(R.id.driverPhoneNumber);
        dCall= (Button) findViewById(R.id.btn_Call);
// set text fields diasble
        dName.setEnabled(false);
        dVehical.setEnabled(false);
        dStatus.setEnabled(false);
        dPhoneNo.setEnabled(false);

//Start of fetching data
        new fetchData().execute();
    }


    public class fetchData extends AsyncTask<String,String,String>{

        @Override
        protected String doInBackground(String... params) {

            try {


                List<NameValuePair> args=new ArrayList<>();
                String driverUserName="Saman";
                int status=0;
            
                args.add(new BasicNameValuePair("driverUserName",driverUserName));

                JSONObject json=jsonParser.makeHttpRequest(FETCH_DRIVE_DETAILS_URL,"POST",args);

                Log.d("Retriving Jeson Values",json.toString());

                status = json.getInt("sucess");
                if(status==1){

                    name=json.get("FName").toString();
                    certification=json.get("Certification").toString();
                    phone=json.get("Phone_No").toString();
                    Type=json.get("Type").toString();

              }else if(status==0){

                }
            }catch (JSONException e){
                System.out.println("JSONE Excepyion Retriving Driver details : "+ e);
            }
            

            return null;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(ViewDriverProfile.this);
            pDialog.setMessage("Fetching Data...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pDialog.dismiss();

            //filling tf

            dName.setText(name);
            dVehical.setText(Type);
            dStatus.setText(certification);
            dPhoneNo.setText(phone);

        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_view_driver_profile, menu);
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
    public void onClick(View v) {

        switch (v.getId()){
            case R.id.btn_Call:
            {
                String phoneNumber;
                // nullchecking and get values
                phoneNumber = dPhoneNo.getText().toString().isEmpty() ? "null" :dPhoneNo.getText().toString();
                //start make call activity
                makeCall(phoneNumber);
                break;
            }
            case R.id.btn_getLocation:
                break;
            case R.id.btn_ReportDriverProfile:
                Intent reportDriver=new Intent(ViewDriverProfile.this,Report.class);
                startActivity(reportDriver);
                break;
            case R.id.btn_RateDriverProfile:
                Intent rateDriver=new Intent(ViewDriverProfile.this,RateDrivers.class);
                startActivity(rateDriver);
                break;
        }
    }

    public void makeCall(String phoneNumber){

        //phone number status
        if (phoneNumber=="null")
        {
            Toast.makeText(getApplicationContext(),"Invalid Phone Number ",Toast.LENGTH_LONG).show();
        }
        else{

            try {
                Intent callIntent = new Intent(Intent.ACTION_CALL,Uri.parse(phoneNumber));
                callIntent.setData(Uri.parse("tel:"+phoneNumber));
                startActivity(callIntent);
            }catch (ActivityNotFoundException e){
                System.out.println(e);
            }

        }

    }
}
