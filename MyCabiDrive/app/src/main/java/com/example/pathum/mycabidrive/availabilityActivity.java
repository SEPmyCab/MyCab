package com.example.pathum.mycabidrive;

import android.content.Context;
import android.location.LocationManager;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;

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

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;


public class availabilityActivity extends ActionBarActivity implements View.OnClickListener,AdapterView.OnItemSelectedListener{
    //  private GoogleApiClient mGoogleApiClient;
    String Availablity;
    Double latitude=0.00;
    Double longitiude=0.00;
    private ProgressDialog pDialog;
    String userName="saman";
    String selectedVehical;



    Location location;
    JSONParser availabilityupdates=new JSONParser();
    private static final String FETCH_VEHICLES_URL = "http://unibook.byethost15.com/myCab/fetch_vehicles.php";
    private static final String UPDATE_AVAILABILITY_URL="http://unibook.byethost15.com/myCab/driverLocationUpdate2.php";
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
    private ArrayList<Vehicle> vehicle;






    Spinner selectVehicalSpinner;

    Intent i;

    Button btn_availability;
    Button btn_notAvailability;
    Button btn_selectVehical;
    Timer timer=new Timer();
    MyTimerTask myTimerTask=new MyTimerTask();


    // private LocationRequest mLocationRequest;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_availability2);
        btn_availability = (Button) findViewById(R.id.btn_available);
        btn_notAvailability= (Button) findViewById(R.id.btn_notAvailable);
        selectVehicalSpinner= (Spinner) findViewById(R.id.spi_SelectVehical);
        btn_availability.setEnabled(false);
        btn_notAvailability.setEnabled(false);
        selectVehicalSpinner.setEnabled(false);





        // btn_selectVehical = (Button) findViewById(R.id.btn_SelectVehical);

        timer.schedule(myTimerTask, 20000, 20000);

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
      vehicle=new ArrayList<Vehicle>();
    selectVehicalSpinner.setOnItemSelectedListener(this);
     new GetVehicles().execute();
//

    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    class GetVehicles extends AsyncTask<String, String, String> {


        boolean failure = false;


        /**
         * Before starting background thread Show Progress Dialog
         */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(availabilityActivity.this);
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


                JSONObject json =availabilityupdates.makeHttpRequest(FETCH_VEHICLES_URL, "POST", params);



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
                Toast.makeText(availabilityActivity.this, file_url, Toast.LENGTH_LONG).show();
            }
            populateSpinner();

        }
        @Override
        protected void onProgressUpdate(String... values) {
            // super.onProgressUpdate(values);


        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_availability, menu);
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
        switch (v.getId()) {
            case (R.id.btn_SelectVehical):
                selectVehicalSpinner.setEnabled(true);
                btn_availability.setEnabled(true);
                btn_notAvailability.setEnabled(true);
               break;

            case (R.id.spi_SelectVehical):
               // availability.setEnabled(true);
              //  notAvailability.setEnabled(true);
              //  break;

            case (R.id.btn_available):
                setAvailable(v);
                btn_notAvailability.setEnabled(true);
                btn_notAvailability.setBackgroundColor(getResources().getColor(R.color.lightBlue));
                btn_availability.setBackgroundColor(getResources().getColor(R.color.darkBlue));
                btn_availability.setEnabled(false);
                break;

            case (R.id.btn_notAvailable):
                setNotAvailable(v);
                btn_notAvailability.setEnabled(false);
                btn_availability.setEnabled(true);
                btn_notAvailability.setBackgroundColor(getResources().getColor(R.color.darkBlue));
                btn_availability.setBackgroundColor(getResources().getColor(R.color.lightBlue));
                break;


        }
    }


    public void setAvailable(View v){

        Availablity="Available";
        calllocationUpdate(v);





    }

    public void setNotAvailable(View v){

        Availablity="NotAvailable";
        myTimerTask.cancel();
        updateStatus updateNotAvail = new updateStatus();
        updateNotAvail.execute();

    }
    public class MyTimerTask extends TimerTask {


        @Override
        public void run() {



            runOnUiThread(new Runnable() {

                @Override
                public void run() {

                    try {

                        //updating status



                            updateStatus update = new updateStatus();
                            update.execute();



                            Toast.makeText(getApplicationContext(), "Data Passing" + Availablity + latitude + longitiude + userName + selectedVehical, Toast.LENGTH_LONG).show();

                    } catch (Exception e) {
                        Toast.makeText(getApplicationContext(),"Data not Passing",Toast.LENGTH_LONG).show();
                        e.printStackTrace();

                    }


                }
            });

        }
    }

public void calllocationUpdate(View v){
locationUpdate obj=new locationUpdate();
    obj.onLocationChanged(location);
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
public class locationUpdate implements LocationListener{

    @Override
    public void onLocationChanged(Location location) {
        LocationManager locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 2000, 10, this);

        try {
            latitude = location.getLatitude();
            longitiude = location.getLongitude();


            System.out.println("");
        }catch (Exception e){
            System.out.println(e);
        }

    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }
}

    class updateStatus extends AsyncTask<String,String,String> {

        @Override
        protected String doInBackground(String... params) {



            List<NameValuePair> values = new ArrayList<NameValuePair>();
            values.add(new BasicNameValuePair("Availability", ""+Availablity));
            values.add(new BasicNameValuePair("latitude", ""+latitude));
            values.add(new BasicNameValuePair("longitiude", ""+longitiude));
            values.add(new BasicNameValuePair("userName", userName));
            values.add(new BasicNameValuePair("selectedVehical", selectedVehical));
            availabilityupdates.makeHttpRequest(UPDATE_AVAILABILITY_URL, "POST", values);
            return null;
        }
    }
}
