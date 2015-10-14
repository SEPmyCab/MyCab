package com.example.pathum.mycabidrive;

import android.app.ProgressDialog;
import android.location.LocationListener;
import android.widget.AdapterView;
import android.content.Intent;
import android.content.SharedPreferences;
import android.location.Location;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;

//import com.google.android.gms.common.ConnectionResult;
//import com.google.android.gms.common.api.GoogleApiClient;
//import com.google.android.gms.location.LocationRequest;
//import com.google.android.gms.location.LocationServices;
//import android.location.Location;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;


//public class Availability extends ActionBarActivity implements GoogleApiClient.ConnectionCallbacks,GoogleApiClient.OnConnectionFailedListener,LocationListener,AdapterView.OnItemSelectedListener,View.OnClickListener{
public class Availability extends ActionBarActivity implements View.OnClickListener{
    //  private GoogleApiClient mGoogleApiClient;
    Boolean Availablity;
    Double latitude=0.00;
    Double longitiude=0.00;
    private ProgressDialog pDialog;
    String driverID;
    String selectedVehical;
    String url="";

    Location location;
    JSONParser availabilityupdates=new JSONParser();
    private static final String FETCH_VEHICLES_URL = "http://blinkcab.host56/myCab2/fetch_vehicles.php";
    private static final String UPDATE_AVAILABILITY_URL="http://blinkcab.host56/myCab2/driverLocationUpdate2.php";
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
    private ArrayList<Vehicle> vehicle;

    ArrayAdapter<CharSequence> adapter;

    availabilityUpdater availabilityupdater=new availabilityUpdater();

    List<NameValuePair> params = new ArrayList<NameValuePair>();
    Spinner selectVehicalSpinner;

    Intent i;

    Button availability;
    Button notAvailability;
    Button selectVehical;
    Timer timer=new Timer();
    MyTimerTask myTimerTask=new MyTimerTask();
    // private LocationRequest mLocationRequest;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_availability);
        availability = (Button) findViewById(R.id.btn_available);
        notAvailability= (Button) findViewById(R.id.btn_notAvailable);
        //  selectVehical = (Button) findViewById(R.id.btn_SelectVehical);
        selectVehicalSpinner= (Spinner) findViewById(R.id.spi_SelectVehical);

//        i=new Intent();  mGoogleApiClient = new GoogleApiClient.Builder(this)
//                .addConnectionCallbacks(this)
//                .addOnConnectionFailedListener(this)
//                .addApi(LocationServices.API)
//                .build();
//        mLocationRequest = LocationRequest.create()
//                .setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY)
//                .setInterval(10 * 1000)        // 10 seconds, in milliseconds
//                .setFastestInterval(1 * 1000);
//        driverID=i.getStringExtra("userID");
//        vehicle=new ArrayList<Vehicle>();
//        selectVehicalSpinner.setOnItemSelectedListener(this);
//        new GetVehicles().execute();
//

    }
    @Override
    protected void onResume() {
        super.onResume();

        //  mGoogleApiClient.connect();
    }

//    @Override
//    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
//
//    }
//
//    @Override
//    public void onNothingSelected(AdapterView<?> parent) {
//
//    }
//
//    @Override
//    public void onLocationChanged(Location location) {
//
//    }
//
//    @Override
//    public void onStatusChanged(String provider, int status, Bundle extras) {
//
//    }
//
//    @Override
//    public void onProviderEnabled(String provider) {
//
//    }
//
//    @Override
//    public void onProviderDisabled(String provider) {
//
//    }

//    @Override
//    public void onConnected(Bundle bundle) {
//      //  location = LocationServices.FusedLocationApi.getLastLocation(mGoogleApiClient);
//
//    }

//    @Override
//    public void onConnectionSuspended(int i) {
//
//    }

//    @Override
//    public void onConnectionFailed(ConnectionResult connectionResult) {
//
//    }


    class GetVehicles extends AsyncTask<String, String, String> {


        boolean failure = false;


        /**
         * Before starting background thread Show Progress Dialog
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(Availability.this);
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



                Log.d("request!", "starting" + nic);


                JSONObject json = availabilityupdates.makeHttpRequest(FETCH_VEHICLES_URL, "POST", params);



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
                Toast.makeText(Availability.this, file_url, Toast.LENGTH_LONG).show();
            }
            populateSpinner();

        }
        @Override
        protected void onProgressUpdate(String... values) {
            // super.onProgressUpdate(values);


        }
    }
    @Override
    public void onClick(View v) {
        switch (v.getId()){
             case (R.id.btn_SelectVehical):
                selectVehicalSpinner.setEnabled(true);
               break;

            case (R.id.spi_SelectVehical):
                //availability.setEnabled(true);
                //notAvailability.setEnabled(true);
                break;

            case (R.id.btn_available):
                setAvailable(v);
                notAvailability.setEnabled(true);
                availability.setEnabled(false);
                break;

            case (R.id.btn_notAvailable):
                setNotAvailable(v);
                notAvailability.setEnabled(false);
                availability.setEnabled(true);
                break;



        }



    }

    public void setAvailable(View v){


        Availablity=true;
       // latitude=location.getLatitude();
        //longitiude=location.getLongitude();


        params.add(new BasicNameValuePair("Availablity", ""+Availablity));
        params.add(new BasicNameValuePair("latitude", ""+latitude));
        params.add(new BasicNameValuePair("longitiude", ""+longitiude));
        params.add(new BasicNameValuePair("driverID", driverID));
        params.add(new BasicNameValuePair("selectedVehical", selectedVehical));




        timer.schedule(myTimerTask, 20000, 20000);



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


        selectVehicalSpinner.setAdapter(spinnerAdapter);
    }

    public void setNotAvailable(View v){

        Availablity=true;
        params.add(new BasicNameValuePair("Availablity", ""+Availablity));
        availabilityupdates.makeHttpRequest(UPDATE_AVAILABILITY_URL, "POST", params);




    }

    public class MyTimerTask extends TimerTask{


        @Override
        public void run() {



            runOnUiThread(new Runnable() {

                @Override
                public void run() {

                    try {

                        //updating status

                        availabilityupdates.makeHttpRequest(UPDATE_AVAILABILITY_URL, "POST", params);


                    } catch (Exception e) {
                        e.printStackTrace();

                    }


                }
            });

        }
    }

}
