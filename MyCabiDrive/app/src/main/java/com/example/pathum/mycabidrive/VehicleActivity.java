package com.example.pathum.mycabidrive;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class VehicleActivity extends ActionBarActivity implements AdapterView.OnItemSelectedListener,View.OnClickListener {

    Spinner Vehicletype;
    private ProgressDialog pDialog;
    private Spinner spinnerVehicle;
    String ACV;
    RadioGroup rp;
    RadioButton rac;
    RadioButton rnonac;
    String type;
    String Manu;
    String Model;

    EditText ManuFi;
    EditText ModelFi;
    EditText RegNOFi;
    EditText SeatsFi;

   int Seats;
    String AC;
EditText rno;

    JSONParser jsonParser = new JSONParser();
    private static final String FETCH_VEHICLE_DETAILS_URL = "http://unibook.byethost15.com/myCab/fetch_vehicle_details.php";
    private static final String FETCH_VEHICLES_URL = "http://unibook.byethost15.com/myCab/fetch_vehicles.php";
    private static final String SAVE_VEHICLE_URL = "http://unibook.byethost15.com/myCab/save_vehicle.php";
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
    private static final String TAG_SUCCESS1= "success";
    private static final String TAG_MESSAGE1= "message";
  //  ArrayList<String> vehiclelist;
    private ArrayList<Vehicle> vehicle;
    JSONObject jsonobject;
    JSONArray jsonarray;
    ArrayAdapter<CharSequence> adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_vehicle);
        getSupportActionBar().hide();
       spinnerVehicle = (Spinner) findViewById(R.id.spinner1);
        Vehicletype= (Spinner) findViewById(R.id.SP_vehicle_Typeu);
       // rno=(EditText)findViewById(R.id.ET_Reg_Nou);
        rac=(RadioButton)findViewById(R.id.acu);
        rnonac=(RadioButton)findViewById(R.id.non_acu);
        ManuFi=(EditText)findViewById(R.id.ET_manuu);
        ModelFi=(EditText)findViewById(R.id.ET_modelu);
        SeatsFi=(EditText)findViewById(R.id.ET_seatsu);

        vehicle=new ArrayList<Vehicle>();
        spinnerVehicle.setOnItemSelectedListener(this);

        adapter = ArrayAdapter.createFromResource(VehicleActivity.this,R.array.vehicle_array, android.R.layout.simple_spinner_item);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        Vehicletype.setAdapter(adapter);

        new GetVehicles().execute();

        rp=(RadioGroup)findViewById(R.id.radioGroupu);
        rp.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener()
        {
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                // checkedId is the RadioButton selected
                RadioButton rb=(RadioButton)findViewById(checkedId);
                ACV=rb.getText().toString();
                //Toast.makeText(getApplicationContext(), rb.getText(), Toast.LENGTH_SHORT).show();
            }
        });
        spinnerVehicle.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                new GetVehicleDetails().execute();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here
            }

        });
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){

            case R.id.B_add_vehicleu:
                new SaveVehicle().execute();
                break;


        }
    }

    class GetVehicleDetails extends AsyncTask<String, String, String> {


        boolean failure = false;


        /**
         * Before starting background thread Show Progress Dialog
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(VehicleActivity.this);
            pDialog.setMessage("Fetching Vehicle Details...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

            // pDialog.dismiss();
        }

        /**
         * Creating product
         */

        @Override
        protected String doInBackground(String... args) {

           /*
            TODO Auto-generated method stub
            Check for success tag
            */

            int success;



            try {


                String regno = spinnerVehicle.getSelectedItem().toString();
                List<NameValuePair> params = new ArrayList<NameValuePair>();
               // String regno=rno.getText().toString();

                params.add(new BasicNameValuePair("regno", regno));



                Log.d("request!", "starting");


                JSONObject json = jsonParser.makeHttpRequest(FETCH_VEHICLE_DETAILS_URL, "POST", params);



                Log.d("Retrieve attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {

                    type=json.getString("type");
                    Manu=json.getString("manu");
                    Model=json.getString("model");
                    Seats=json.getInt("seats");

                    AC=json.getString("ac");
                    this.publishProgress(type,Manu,Model,String.valueOf(Seats),AC);
                    Log.d("Vehicle Recieved!", json.toString());

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
                Toast.makeText(VehicleActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
        @Override
        protected void onProgressUpdate(String... values) {
            super.onProgressUpdate(values);
            if(values[0].equals("car")) {
                Vehicletype.setSelection(adapter.getPosition("car"), false);

            }
            else if(values[0].equals("van")) {
               Vehicletype.setSelection(adapter.getPosition("var"),false);

            }
            else if(values[0].equals("three wheeler")) {
                Vehicletype.setSelection(adapter.getPosition("three wheeler"),false);
            }
            else if(values[0].equals("bus")) {
                Vehicletype.setSelection(adapter.getPosition("bus"),false);
            }
            else if(values[0].equals("truck")) {
                Vehicletype.setSelection(adapter.getPosition("truck"),false);
            }

            ManuFi.setText(values[1]);
            ModelFi.setText(values[2]);
            SeatsFi.setText(values[3]);
            if(values[4]!=""){
            if(values[4].charAt(0)=='A'| values[4].charAt(0)=='a')
            {
                rac.setChecked(true);
            }
            else
            {
                rnonac.setChecked(true);
            }}
            else{rnonac.setChecked(true);}
        }
    }
    class GetVehicles extends AsyncTask<String, String, String> {


        boolean failure = false;


        /**
         * Before starting background thread Show Progress Dialog
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(VehicleActivity.this);
            pDialog.setMessage("Fetching Vehicles");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();

            // pDialog.dismiss();
        }

        /**
         * Creating product
         */

        @Override
        protected String doInBackground(String... args) {

           /*
            TODO Auto-generated method stub
            Check for success tag
            */

            int success;



            try {

                SharedPreferences mySharedPreferences ;
                mySharedPreferences=getSharedPreferences("MyPref",0);
                String nic= mySharedPreferences.getString("nic","");
                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("nic", nic));



                Log.d("request!", "starting"+nic);


                JSONObject json = jsonParser.makeHttpRequest(FETCH_VEHICLES_URL, "POST", params);



                Log.d("Fetch vehicle attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {
                   try {

                       if (json != null) {
                           JSONArray categories = json.getJSONArray("vehicles");

                           for (int i = 0; i < categories.length(); i++) {
                               JSONObject catObj = (JSONObject) categories.get(i);
                               Vehicle ve = new Vehicle(catObj.getString("Reg_No"));
                               Log.d("Adding vehicles", catObj.getString("Reg_No"));
                               vehicle.add(ve);

                           }
                       }
                   }
                       catch (JSONException e) {
                           e.printStackTrace();
                       }


                    Log.d("Vehicles Recieved!", json.toString());

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
            // dismiss the dialog once product deleted
            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(VehicleActivity.this, file_url, Toast.LENGTH_LONG).show();
            }
            populateSpinner();

        }
        @Override
        protected void onProgressUpdate(String... values) {
           // super.onProgressUpdate(values);


        }
    }

    class SaveVehicle extends AsyncTask<String, String, String> {
        boolean failure = false;


        /**
         * Before starting background thread Show Progress Dialog
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(VehicleActivity.this);
            pDialog.setMessage("Saving Changes...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }

        /**
         * Creating product
         */
        protected String doInBackground(String... arg0) {

            int success;


            String Regno = spinnerVehicle.getSelectedItem().toString();
            String Type = Vehicletype.getSelectedItem().toString();
            String Manu=ManuFi.getText().toString();
            String Model = ModelFi.getText().toString();
            String Seats = SeatsFi.getText().toString();





                try {// Building Parameters
                    List<NameValuePair> params = new ArrayList<NameValuePair>();

                    params.add(new BasicNameValuePair("regno", Regno));
                    params.add(new BasicNameValuePair("type", Type));
                    params.add(new BasicNameValuePair("manu", Manu));
                    params.add(new BasicNameValuePair("model", Model));
                    params.add(new BasicNameValuePair("seats", Seats));
                    params.add(new BasicNameValuePair("ac", ACV));

                    Log.d("request!", "starting");
                    //Posting user data to script
                    JSONObject json1 = jsonParser.makeHttpRequest(SAVE_VEHICLE_URL, "POST", params);
                    // full json response
                    Log.d("Save attempt", json1.toString());
                    // json success element
                    success = json1.getInt(TAG_SUCCESS1);
                    if (success == 1) {
                        Log.d("Changed are Saved!", json1.toString());
                        Intent intent = new Intent(VehicleActivity.this, MainActivity.class);

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

        /**
         * After completing background task Dismiss the progress dialog
         * *
         */
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(VehicleActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }

    private void populateSpinner() {
        List<String> lables = new ArrayList<String>();



        for (int i = 0; i < vehicle.size(); i++) {
            lables.add(vehicle.get(i).getReg_no());
           //lables.add();

        }
        //Log.d("List",vehicle.get(1).getReg_no());

        ArrayAdapter<String> spinnerAdapter = new ArrayAdapter<String>(this,
                android.R.layout.simple_spinner_item, lables);


        spinnerAdapter
                .setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);


        spinnerVehicle.setAdapter(spinnerAdapter);
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_vehicle, menu);
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
