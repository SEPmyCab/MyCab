package com.example.pathum.mycabpickme;
/**
 * Created by Nu on 8/12/2015.
 */
import android.app.AlertDialog;
import android.app.DownloadManager;
import android.app.Fragment;
import android.app.FragmentManager;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentSender;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.PixelFormat;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.ActionBarDrawerToggle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Filter;
import android.widget.Filterable;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;


public class RequestActivity extends ActionBarActivity implements GoogleApiClient.ConnectionCallbacks,GoogleApiClient.OnConnectionFailedListener, com.google.android.gms.location.LocationListener,View.OnClickListener,AdapterView.OnItemClickListener,AdapterView.OnItemSelectedListener ,GoogleMap.OnMapClickListener, GoogleMap.OnMapLongClickListener,GoogleMap.OnMarkerDragListener {


    private GoogleMap mMap;
    private GoogleApiClient mGoogleApiClient;
    private LocationRequest mLocationRequest;

    ArrayList<LatLng> markerPoints;

    public static double Latitude, Longitude;

    AutoCompleteTextView autoCompViewPick,autoCompViewDes;
    List<Polyline> polylines = new ArrayList<Polyline>();
    Spinner spType;
    SurfaceView sfvTrack;
    RelativeLayout rel;
    Button close,open;
    DBHelper db=new DBHelper(this);

    public static final String TAG = MapsActivity.class.getSimpleName();

    JSONParser jsonParser = new JSONParser();

    private ProgressDialog pDialog;

    Marker pick,des,pass;
    String pickcode,destcode;
    ////////////////////////////////////////////////////////////////////
    /**
     * Variables for navigation drawer
     */
    private String[] mNavigationDrawerItemTitles;
    private DrawerLayout mDrawerLayout;
    private ListView mDrawerList;
    ActionBarDrawerToggle mDrawerToggle;
    private CharSequence mDrawerTitle;
    private CharSequence mTitle;
    Favourites selectedFav;
    String pickFromFav;
    String desFromFav;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
      //  Thread.setDefaultUncaughtExceptionHandler(new ExceptionHandler(this));
        setContentView(R.layout.activity_request);
        ////////////////////////////
        mTitle = mDrawerTitle = getTitle();
        mNavigationDrawerItemTitles= getResources().getStringArray(R.array.navigation_drawer_items_array);
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerList = (ListView) findViewById(R.id.left_drawer);
        ObjectDrawerItem[] drawerItem = new ObjectDrawerItem[4];

        drawerItem[0] = new ObjectDrawerItem(R.drawable.ic_home, "Book Now");
        drawerItem[1] = new ObjectDrawerItem(R.drawable.ic_trip, "My Trips");
        drawerItem[2] = new ObjectDrawerItem(R.drawable.ic_profile, "Profile");
        drawerItem[3] = new ObjectDrawerItem(R.drawable.ic_heart, "Favourites");
        DrawerItemCustomAdapter adapter1 = new DrawerItemCustomAdapter(this, R.layout.listview_item_row, drawerItem);
        mDrawerList.setAdapter(adapter1);
        mDrawerList.setOnItemClickListener(new DrawerItemClickListener());
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerToggle = new ActionBarDrawerToggle(
                this,
                mDrawerLayout,
                R.string.drawer_open,
                R.string.drawer_close
        ) {

            /** Called when a drawer has settled in a completely closed state. */
            public void onDrawerClosed(View view) {
                super.onDrawerClosed(view);
                getSupportActionBar().setTitle(mTitle);
            }

            /** Called when a drawer has settled in a completely open state. */
            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);
                getSupportActionBar().setTitle(mDrawerTitle);
                mDrawerList.bringToFront();
                mDrawerLayout.requestLayout();
            }
        };

        mDrawerLayout.setDrawerListener(mDrawerToggle);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setHomeButtonEnabled(true);
        /////////////////////////////

        sfvTrack = (SurfaceView)findViewById(R.id.surfaceView1);
        rel=(RelativeLayout)findViewById(R.id.rlrequest);
        autoCompViewPick = (AutoCompleteTextView) findViewById(R.id.et_pick);
        autoCompViewDes = (AutoCompleteTextView) findViewById(R.id.et_dest);
        spType=(Spinner)findViewById(R.id.sp_type);
        close=(Button)findViewById(R.id.btnclose);
        open=(Button)findViewById(R.id.btnopen);

        if(this.getIntent().hasExtra("id"))
        {
            pickFromFav=this.getIntent().getStringExtra("pick");
            desFromFav=this.getIntent().getStringExtra("dest");
            autoCompViewPick.setText(pickFromFav);
            autoCompViewDes.setText(desFromFav);
        }
        autoCompViewPick.setAdapter(new GooglePlacesAutocompleteAdapterPickup(this, R.layout.list_item));
        autoCompViewPick.setOnItemClickListener(this);




        autoCompViewDes.setAdapter(new GooglePlacesAutocompleteAdapterDestination(this, R.layout.list_item));
        autoCompViewDes.setOnItemClickListener(this);
        sfvTrack.setZOrderOnTop(true);

        SurfaceHolder sfhTrackHolder = sfvTrack.getHolder();
        sfhTrackHolder.setFormat(PixelFormat.TRANSPARENT);
        LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);
        markerPoints = new ArrayList<LatLng>();
        setUpMapIfNeeded();
        //initialize Google Api Client
        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API)
                .build();
        //initialize location request
        mLocationRequest = LocationRequest.create()
                .setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY)
                .setInterval(10 * 1000)        // 10 seconds, in milliseconds
                .setFastestInterval(1 * 1000);

        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(RequestActivity.this,R.array.vehicle_array, android.R.layout.simple_spinner_item);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spType.setAdapter(adapter);
        mMap.setOnMapClickListener(new GoogleMap.OnMapClickListener() {

            @Override
            public void onMapClick(LatLng point) {
                // TODO Auto-generated method stub
                markerPoints.add(point);

                if (markerPoints.size() == 1) {
                    mMap.animateCamera(CameraUpdateFactory.newLatLng(point));

                    pick.setPosition(point);
                    pick.setIcon(BitmapDescriptorFactory.fromResource(R.drawable.frompin));
                    pick.setDraggable(true);
                    pick.setTitle("Pickup");
                    pick.setVisible(true);

                    autoCompViewPick.setText(getCompleteAddressString(point.latitude,point.longitude));
                    pickcode=pick.getPosition().latitude+","+pick.getPosition().longitude;
                    autoCompViewDes.setEnabled(true);
                }
                else if (markerPoints.size() == 2) {
                    mMap.animateCamera(CameraUpdateFactory.newLatLng(point));

                    des.setPosition(point);
                    des.setIcon(BitmapDescriptorFactory.fromResource(R.drawable.topin));
                    des.setDraggable(true);
                    des.setTitle("Destination");
                    des.setVisible(true);

                    autoCompViewDes.setText(getCompleteAddressString(point.latitude,point.longitude));
                    destcode=des.getPosition().latitude+","+des.getPosition().longitude;


                    new DownloadTask().execute(getDirectionsUrl(markerPoints.get(0), markerPoints.get(1)));

                }
            }

        });
        mMap.setOnMarkerDragListener(this);
        Button favourites=(Button) findViewById(R.id.btnFav);
        favourites.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Intent intent = new Intent(RequestActivity.this,FavouriteList.class);


                //=================================================================================
                final AlertDialog.Builder alert = new AlertDialog.Builder(RequestActivity.this);
                final EditText input = new EditText(RequestActivity.this);
                alert.setView(input);
                alert.setTitle("Add To Favourites");
                alert.setMessage("Enter Name for Favourite!!");
                alert.setIcon(R.drawable.blue_favourite);

                alert.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {
                        String value = input.getText().toString().trim();
                        db.open();
                        db.insertRecord(value, autoCompViewPick.getText().toString(), autoCompViewDes.getText().toString(), spType.getSelectedItem().toString());
                        db.close();
                        //intent.putExtra("fname",value);
                        Toast.makeText(getApplicationContext(), value, Toast.LENGTH_SHORT).show();
                        startActivity(intent);
                    }
                });

                alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {
                        dialog.cancel();
                        startActivity(intent);
                        Intent intent=getIntent();
                        int id=intent.getIntExtra("book",-1);
                        Log.i("id", String.valueOf(id));
                        selectedFav=db.getFavourite(id);

                    }
                });
                alert.show();
                //================================================================================
                //startActivity(intent);

            }
        });

    }
    ///////////////////////////////////
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (mDrawerToggle.onOptionsItemSelected(item)) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
    @Override
    public void setTitle(CharSequence title) {
        mTitle = title;
        getActionBar().setTitle(mTitle);
    }
    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);
        mDrawerToggle.syncState();
    }
    //////////////////////////////////////
    @Override
    protected void onResume() {
        super.onResume();
        setUpMapIfNeeded();
        mGoogleApiClient.connect();
    }
    @Override
    protected void onPause() {
        super.onPause();
        if (mGoogleApiClient.isConnected()) {
            LocationServices.FusedLocationApi.removeLocationUpdates(mGoogleApiClient, this);
            mGoogleApiClient.disconnect();
        }
    }
    private void setUpMapIfNeeded() {
        // Do a null check to confirm that we have not already instantiated the map.
        if (mMap == null) {
            // Try to obtain the map from the SupportMapFragment.
            mMap = ((SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map))
                    .getMap();
            LatLng latLng = new LatLng(0.0, 0.0);
            MarkerOptions options = new MarkerOptions()
                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.frompin))
                    .flat(true)
                    .position(latLng)
                    .draggable(true)
                    .rotation(0);

            pick=mMap.addMarker(options);
            pick.setVisible(false);
            des=mMap.addMarker(options);
            des.setVisible(false);

            // Check if we were successful in obtaining the map.
            if (mMap != null) {
                setUpMap();
            }
        }
    }
    private void setUpMap() {

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_driver, menu);
        return true;
    }



    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case(R.id.btnReq):
                if(autoCompViewPick.getText().toString().equals("")) {
                    Toast.makeText(this, "Please provide pick up location", Toast.LENGTH_LONG).show();
                }
                else if(autoCompViewDes.getText().toString().equals("")) {
                    Toast.makeText(this, "Please provide destination", Toast.LENGTH_LONG).show();
                }
                else {
                    new SendRequest().execute();
                    new NotifyDriver().execute();
                }
                break;
            case(R.id.btnclose):
                close.setVisibility(View.GONE);
                open.setVisibility(View.VISIBLE);

                    sfvTrack.setVisibility(View.GONE);
                    rel.setVisibility(View.GONE);

                break;
            case(R.id.btnopen):
                close.setVisibility(View.VISIBLE);
                open.setVisibility(View.GONE);
                rel.setVisibility(View.VISIBLE);
                sfvTrack.setVisibility(View.VISIBLE);
                break;
        }
    }

    @Override
    public void onConnected(Bundle bundle) {
        Log.i(TAG, "Location services connected.");
        Location location = LocationServices.FusedLocationApi.getLastLocation(mGoogleApiClient);
        if (location == null) {
            LocationServices.FusedLocationApi.requestLocationUpdates(mGoogleApiClient, mLocationRequest,this);
        }
        else {
            handleNewLocation(location);
        };
    }

    /**
     * This method plots a marker
     * according to the current location of the
     * passenger
     * @param location current location of the passenger
     */
    private void handleNewLocation(Location location) {
        Log.d(TAG, location.toString());

        double currentLatitude = location.getLatitude();
        double currentLongitude = location.getLongitude();

        LatLng latLng = new LatLng(currentLatitude, currentLongitude);

        MarkerOptions options = new MarkerOptions()
                .icon(BitmapDescriptorFactory.fromResource(R.drawable.passenger))
                .flat(true)
                .rotation(0)
                .position(latLng)
                .title("I am here!");
        mMap.clear();
        mMap.addMarker(options);
        float zoomlevel = 14;
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, zoomlevel));
        CameraPosition cameraPosition = CameraPosition.builder()
                .target(latLng)
                .zoom(14)
                .bearing(90)
                .build();


    }

    /**
     * Update map when new pickup location is given
     * @param lat
     * @param longi
     */
    private void handleNewPickupLocation(double lat,double longi) {
        LatLng latLng = new LatLng(lat, longi);
        markerPoints.add(0,latLng);

        pick.setPosition(latLng);
        des.setIcon(BitmapDescriptorFactory.fromResource(R.drawable.frompin));
        pick.setVisible(true);
        pickcode=pick.getPosition().latitude+","+pick.getPosition().longitude;
        float zoomlevel = 14;

        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, zoomlevel));
        CameraPosition cameraPosition = CameraPosition.builder()
                .target(latLng)
                .zoom(14)
                .bearing(90)
                .build();
        autoCompViewDes.setEnabled(true);

    }

    /**
     * Update map when new destination is given
     * @param lat
     * @param longi
     */
    private void handleNewDestination(double lat,double longi) {
    try {

    LatLng latLng = new LatLng(lat, longi);
    markerPoints.add(1, latLng);

    des.setPosition(latLng);
    des.setIcon(BitmapDescriptorFactory.fromResource(R.drawable.topin));
    des.setVisible(true);
    float zoomlevel = 14;
    destcode = des.getPosition().latitude + "," + des.getPosition().longitude;
    mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, zoomlevel));
    CameraPosition cameraPosition = CameraPosition.builder()
            .target(latLng)
            .zoom(14)
            .bearing(90)
            .build();
    LatLng origin = markerPoints.get(0);
    LatLng dest = markerPoints.get(1);
    String url = getDirectionsUrl(origin, dest);

    DownloadTask downloadTask = new DownloadTask();

    // Start downloading json data from Google Directions API
    downloadTask.execute(url);
}
catch (IndexOutOfBoundsException e)
{
    Toast.makeText(this,"Please select pick up location first", Toast.LENGTH_SHORT).show();


}

    }
    @Override
    public void onConnectionSuspended(int i) {

    }

    @Override
    public void onLocationChanged(Location location) {
        //handleNewLocation(location);
    }

    @Override
    public void onConnectionFailed(ConnectionResult connectionResult) {
        if (connectionResult.hasResolution()) {
            try {
                // Start an Activity that tries to resolve the error
                connectionResult.startResolutionForResult(this, ApplicationConstants.CONNECTION_FAILURE_RESOLUTION_REQUEST);
            } catch (IntentSender.SendIntentException e) {
                e.printStackTrace();
            }
        } else {
            Log.i(TAG, "Location services connection failed with code " + connectionResult.getErrorCode());
        }
    }

    @Override
    public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {

        String str = (String) adapterView.getItemAtPosition(position);
            new  GetGeoCodeTask().execute(str);
        Toast.makeText(this, str, Toast.LENGTH_SHORT).show();


    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    @Override
    public void onMarkerDragStart(Marker marker) {
      /*  marker.getPosition();
        Log.d("sdsd",marker.getTitle());
        if( marker.getTitle()=="Pickup")
        {

            autoCompViewPick.setText(getCompleteAddressString(marker.getPosition().latitude, marker.getPosition().longitude));
        }
        else
        {
            autoCompViewDes.setText(getCompleteAddressString(marker.getPosition().latitude, marker.getPosition().longitude));
        }*/
    }

    @Override
    public void onMarkerDrag(Marker marker) {

    }

    @Override
    public void onMarkerDragEnd(Marker marker) {
      try {
          marker.getPosition();

          Log.d("sdsd", marker.getTitle());
          if (marker.getTitle().equals("Pickup")) {

              autoCompViewPick.setText(getCompleteAddressString(marker.getPosition().latitude, marker.getPosition().longitude));
              markerPoints.add(0, marker.getPosition());
              pickcode = marker.getPosition().latitude + "," + marker.getPosition().longitude;
          } else if (marker.getTitle().equals("Destination")) {
              autoCompViewDes.setText(getCompleteAddressString(marker.getPosition().latitude, marker.getPosition().longitude));
              markerPoints.add(1, marker.getPosition());
              destcode = des.getPosition().latitude + "," + des.getPosition().longitude;
          }
          LatLng origin = markerPoints.get(0);
          LatLng dest = markerPoints.get(1);
          String url = getDirectionsUrl(origin, dest);

          DownloadTask downloadTask = new DownloadTask();

          // Start downloading json data from Google Directions API
          downloadTask.execute(url);
      }
      catch (NullPointerException e)
      {
          Toast.makeText(this,"Please select destination", Toast.LENGTH_SHORT).show();
      }
    }

    @Override
    public void onMapClick(LatLng latLng) {

    }

    @Override
    public void onMapLongClick(LatLng latLng) {

    }

    class SendRequest extends AsyncTask<String, String, String> {


        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(RequestActivity.this);
            pDialog.setMessage("Requesting..");
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


                String NIC="879038767V";
                SharedPreferences mySharedPreferences ;
                mySharedPreferences=getSharedPreferences("MyPrefs",0);
                String email= mySharedPreferences.getString("email","");
                Log.d("Requesting!", "starting");

                List<NameValuePair> params = new ArrayList<NameValuePair>();
                String pickup=autoCompViewPick.getText().toString();
                String dest=autoCompViewDes.getText().toString();
                params.add(new BasicNameValuePair("pickup",pickup));
                params.add(new BasicNameValuePair("pickcodi",pickcode));
                Log.d("Pickup", autoCompViewPick.getText().toString());
                params.add(new BasicNameValuePair("dest",dest));
                params.add(new BasicNameValuePair("destcodi",destcode));
                params.add(new BasicNameValuePair("nic",NIC));
                params.add(new BasicNameValuePair("email",email));
                params.add(new BasicNameValuePair("type",spType.getSelectedItem().toString()));

                JSONObject json = jsonParser.makeHttpRequest(ApplicationConstants.REQUEST_URL, "POST",params);

                Log.d("Request attempt", json.toString());

                success = json.getInt(ApplicationConstants.TAG_SUCCESS);

                if (success == 1) {

                    //    dbNic=json.getString("nic");
//                    dbReqId = json.getString("reqId");
                    Log.d("Notified!", json.toString());

                    return json.getString(ApplicationConstants.TAG_MESSAGE);

                }else{

                    Log.d("Notification Failure!", json.getString(ApplicationConstants.TAG_MESSAGE));

                    return json.getString(ApplicationConstants.TAG_MESSAGE);

                }

            } catch (JSONException e) {

                e.printStackTrace();

            }
            catch (NullPointerException e)
            {
                e.printStackTrace();
            }

            return null;

        }

        @Override
        protected void onPostExecute(String file_url){

             pDialog.dismiss();
            if (file_url != null){

                 Toast.makeText(RequestActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }
    class NotifyDriver extends AsyncTask<String, String, String> {


        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected String doInBackground(String... args) {

       /*
        TODO Auto-generated method stub
        Check for success tag
        */

            int success;

            try {


                Log.d("Notifying!", "starting");

                List<NameValuePair> params = new ArrayList<NameValuePair>();


                JSONObject json = jsonParser.makeHttpRequest(ApplicationConstants.NOTIFY_URL, "POST",params);

                Log.d("Request attempt", json.toString());

                success = json.getInt(ApplicationConstants.TAG_SUCCESS);

                if (success == 1) {


                    Log.d("Notified!", json.toString());

                    return json.getString(ApplicationConstants.TAG_MESSAGE);

                }else{

                    Log.d("Notification Failure!", json.getString(ApplicationConstants.TAG_MESSAGE));

                    return json.getString(ApplicationConstants.TAG_MESSAGE);

                }

            } catch (JSONException e) {

                e.printStackTrace();

            }
            catch (NullPointerException e)
            {
                e.printStackTrace();
            }

            return null;

        }

        @Override
        protected void onPostExecute(String file_url){

            pDialog.dismiss();
            if (file_url != null){

                Toast.makeText(RequestActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }
    public static ArrayList autocomplete(String input) {
        ArrayList resultList = null;

        HttpURLConnection conn = null;
        StringBuilder jsonResults = new StringBuilder();
        try {
            StringBuilder sb = new StringBuilder(ApplicationConstants.PLACES_API_BASE +ApplicationConstants.TYPE_AUTOCOMPLETE + ApplicationConstants.OUT_JSON);
            sb.append("?key=" + ApplicationConstants.API_KEY);
            sb.append("&components=country:lk");
            sb.append("&input=" + URLEncoder.encode(input, "utf8"));

            URL url = new URL(sb.toString());
            conn = (HttpURLConnection) url.openConnection();
            InputStreamReader in = new InputStreamReader(conn.getInputStream());

            // Load the results into a StringBuilder
            int read;
            char[] buff = new char[1024];
            while ((read = in.read(buff)) != -1) {
                jsonResults.append(buff, 0, read);
            }
        } catch (MalformedURLException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Error processing Places API URL", e);
            return resultList;
        } catch (IOException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Error connecting to Places API", e);
            return resultList;
        } finally {
            if (conn != null) {
                conn.disconnect();
            }
        }

        try {
            // Create a JSON object hierarchy from the results
            JSONObject jsonObj = new JSONObject(jsonResults.toString());
            JSONArray predsJsonArray = jsonObj.getJSONArray("predictions");

            // Extract the Place descriptions from the results
            resultList = new ArrayList(predsJsonArray.length());
            for (int i = 0; i < predsJsonArray.length(); i++) {
                System.out.println(predsJsonArray.getJSONObject(i).getString("description"));
                System.out.println("============================================================");
                resultList.add(predsJsonArray.getJSONObject(i).getString("description"));
            }
        } catch (JSONException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Cannot process JSON results", e);
        }

        return resultList;
    }

    /**
     * Taking suggestions for pickup autocomplete field
     */
    class GooglePlacesAutocompleteAdapterPickup extends ArrayAdapter implements Filterable {
        private ArrayList resultList;

        public GooglePlacesAutocompleteAdapterPickup(Context context, int textViewResourceId) {
            super(context, textViewResourceId);
        }

        @Override
        public int getCount() {
            return resultList.size();
        }

        @Override
        public String getItem(int index) {
            return (String) resultList.get(index);
        }


        @Override
        public Filter getFilter() {
            Filter filter = new Filter() {
                @Override
                protected FilterResults performFiltering(CharSequence constraint) {
                    FilterResults filterResults = new Filter.FilterResults();
                    if (constraint != null) {
                        // Retrieve the autocomplete results.
                        resultList = autocomplete(constraint.toString());

                        // Assign the data to the FilterResults
                        filterResults.values = resultList;
                        filterResults.count = resultList.size();


                    }
                    return filterResults;
                }

                @Override
                protected void publishResults(CharSequence constraint, Filter.FilterResults results) {
                    if (results != null && results.count > 0) {
                        notifyDataSetChanged();
                    } else {
                        notifyDataSetInvalidated();
                    }
                }
            };
            return filter;
        }
    }
    public static ArrayList previewDetails(String input) {
        ArrayList resultList = null;

        HttpURLConnection conn = null;
        StringBuilder jsonResults = new StringBuilder();
        try {
            StringBuilder sb = new StringBuilder(ApplicationConstants.PLACES_API_BASE + ApplicationConstants.TYPE_AUTOCOMPLETE + ApplicationConstants.OUT_JSON);
            sb.append("?key=" + ApplicationConstants.API_KEY);
            sb.append("&components=country:lk");
            sb.append("&input=" + URLEncoder.encode(input, "utf8"));

            URL url = new URL(sb.toString());
            conn = (HttpURLConnection) url.openConnection();
            InputStreamReader in = new InputStreamReader(conn.getInputStream());

            // Load the results into a StringBuilder
            int read;
            char[] buff = new char[1024];
            while ((read = in.read(buff)) != -1) {
                jsonResults.append(buff, 0, read);
            }
        } catch (MalformedURLException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Error processing Places API URL", e);
            return resultList;
        } catch (IOException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Error connecting to Places API", e);
            return resultList;
        } finally {
            if (conn != null) {
                conn.disconnect();
            }
        }

        try {
            // Create a JSON object hierarchy from the results
            JSONObject jsonObj = new JSONObject(jsonResults.toString());
            JSONArray predsJsonArray = jsonObj.getJSONArray("predictions");

            // Extract the Place descriptions from the results
            resultList = new ArrayList(predsJsonArray.length());
            for (int i = 0; i < predsJsonArray.length(); i++) {
                System.out.println(predsJsonArray.getJSONObject(i).getString("description"));
                System.out.println("============================================================");
                resultList.add(predsJsonArray.getJSONObject(i).getString("description"));
            }
        } catch (JSONException e) {
            Log.e(ApplicationConstants.LOG_TAG, "Cannot process JSON results", e);
        }

        return resultList;
    }

    /**
     * Taking suggestions for destination autocomplete field
     */
    class GooglePlacesAutocompleteAdapterDestination extends ArrayAdapter implements Filterable {
        private ArrayList resultList;

        public GooglePlacesAutocompleteAdapterDestination(Context context, int textViewResourceId) {
            super(context, textViewResourceId);
        }

        @Override
        public int getCount() {
            return resultList.size();
        }

        @Override
        public String getItem(int index) {
            return (String) resultList.get(index);
        }


        @Override
        public Filter getFilter() {


            Filter filter = new Filter() {
                @Override
                protected FilterResults performFiltering(CharSequence constraint) {
                    FilterResults filterResults = new Filter.FilterResults();
                    if (constraint != null) {
                        // Retrieve the autocomplete results.
                        resultList = previewDetails(constraint.toString());
                        // Assign the data to the FilterResults
                        filterResults.values = resultList;
                        filterResults.count = resultList.size();

                    }
                    return filterResults;

                }

                @Override
                protected void publishResults(CharSequence constraint, Filter.FilterResults results) {
                    if (results != null && results.count > 0) {
                        notifyDataSetChanged();

                    } else {
                        notifyDataSetInvalidated();
                    }
                }
            };
            return filter;
        }
    }

    /**
     *
     * @param address
     * @return JSONObject containing geolocation
     */
    public static JSONObject getLocationInfo(String address) {
        StringBuilder stringBuilder = new StringBuilder();
        try {

            address = address.replaceAll(" ","%20");

            HttpPost httppost = new HttpPost("http://maps.google.com/maps/api/geocode/json?address=" + address + "&sensor=false");
            HttpClient client = new DefaultHttpClient();
            HttpResponse response;
            stringBuilder = new StringBuilder();


            response = client.execute(httppost);
            HttpEntity entity = response.getEntity();
            InputStream stream = entity.getContent();
            int b;
            while ((b = stream.read()) != -1) {
                stringBuilder.append((char) b);
            }
        } catch (ClientProtocolException e) {
        } catch (IOException e) {
        }

        JSONObject jsonObject = new JSONObject();
        try {
            jsonObject = new JSONObject(stringBuilder.toString());
        } catch (JSONException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }

        return jsonObject;
    }

    /**
     *
     * @param jsonObject contains location geocodes
     * @return
     */
    public static boolean getLatLong(JSONObject jsonObject) {

        try {

            Longitude = ((JSONArray)jsonObject.get("results")).getJSONObject(0)
                    .getJSONObject("geometry").getJSONObject("location")
                    .getDouble("lng");

            Latitude = ((JSONArray)jsonObject.get("results")).getJSONObject(0)
                    .getJSONObject("geometry").getJSONObject("location")
                    .getDouble("lat");

        } catch (JSONException e) {
            return false;

        }

        return true;
    }

    /**
     *
     * @param Latitude
     * @param Longitude
     * @return address
     */
    private String getCompleteAddressString(double Latitude, double Longitude) {
        String strAdd = "";
        Geocoder geocoder = new Geocoder(this, Locale.getDefault());
        try {
            List<Address> addresses = geocoder.getFromLocation(Latitude, Longitude, 1);
            if (addresses != null) {
                Address returnedAddress = addresses.get(0);
                StringBuilder strReturnedAddress = new StringBuilder("");

                for (int i = 0; i < returnedAddress.getMaxAddressLineIndex(); i++) {
                    strReturnedAddress.append(returnedAddress.getAddressLine(i)).append("\n");
                }
                strAdd = strReturnedAddress.toString();
                Log.w("My Current location address", "" + strReturnedAddress.toString());
            } else {
                Log.w("My Current location address", "No Address returned!");
            }
        } catch (Exception e) {
            e.printStackTrace();
            Log.w("My Current location address", "Cannot get Address!");
        }
        return strAdd;
    }

    /**
     * This Asynctask is for obtaining latitude and longitude from address
     */
    private class GetGeoCodeTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... args) {

            // params comes from the execute() call: params[0] is the url.
            try {
                getLatLong(getLocationInfo(args[0]));
                return "Geocode recieved";

            } catch (Exception e) {
                return "Unable to get Geocode";
            }
        }
        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {
            //Toast.makeText(this, result+Latitude+Longitude, Toast.LENGTH_SHORT).show();

            if(autoCompViewPick.hasFocus()) {
                handleNewPickupLocation(Latitude,Longitude);
            }else if (autoCompViewDes.hasFocus()) {
                handleNewDestination(Latitude,Longitude);
            }
        }
    }

    /**
     *  Start downloading json data from Google Directions API
     */
    private class DownloadTask extends AsyncTask<String, Void, String> {

        // Downloading data in non-ui thread
        @Override
        protected String doInBackground(String... url) {

            // For storing data from web service
            String data = "";

            try{
                // Fetching the data from web service
                data = downloadUrl(url[0]);
            }catch(Exception e){
                Log.d("Background Task",e.toString());
            }
            return data;
        }
        // Executes in UI thread, after the execution of
        // doInBackground()
        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);

            ParserTask parserTask = new ParserTask();

            // Invokes the thread for parsing the JSON data
            parserTask.execute(result);
        }
    }

    /**
     * This class is for obtaining shortest path for given 2 locations
     * It returns minimum distance and time
     */
    private class ParserTask extends AsyncTask<String, Integer, List<List<HashMap<String,String>>> >{

        // Parsing the data in non-ui thread
        @Override
        protected List<List<HashMap<String, String>>> doInBackground(String... jsonData) {

            JSONObject jObject;
            List<List<HashMap<String, String>>> routes = null;

            try{
                jObject = new JSONObject(jsonData[0]);
                DirectionsJSONParser parser = new DirectionsJSONParser();

                // Starts parsing data
                routes = parser.parse(jObject);
            }catch(Exception e){
                e.printStackTrace();
            }
            return routes;
        }



        /**
         * Executes in UI thread, after the parsing process
         * @param result
         */
        @Override
        protected void onPostExecute(List<List<HashMap<String, String>>> result) {
            ArrayList<LatLng> points = null;
            PolylineOptions lineOptions = null;
            MarkerOptions markerOptions = new MarkerOptions();
            String distance = "";
            String duration = "";

            if(result.size()<1){
                Toast.makeText(getBaseContext(), "No Points", Toast.LENGTH_SHORT).show();
                return;
            }

            // Traversing through all the routes
            for(int i=0;i<result.size();i++){
                points = new ArrayList<LatLng>();
                lineOptions = new PolylineOptions();

                // Fetching i-th route
                List<HashMap<String, String>> path = result.get(i);

                // Fetching all the points in i-th route
                for(int j=0;j<path.size();j++){
                    HashMap<String,String> point = path.get(j);

                    if(j==0){    // Get distance from the list
                        distance = (String)point.get("distance");
                        continue;
                    }else if(j==1){ // Get duration from the list
                        duration = (String)point.get("duration");
                        continue;
                    }

                    double lat = Double.parseDouble(point.get("lat"));
                    double lng = Double.parseDouble(point.get("lng"));
                    LatLng position = new LatLng(lat, lng);

                    points.add(position);
                }

                // Adding all the points in the route to LineOptions
                lineOptions.addAll(points);
                lineOptions.width(5);
                lineOptions.color(Color.RED);
            }
            Toast.makeText(RequestActivity.this, "Distance:"+distance + ", Duration:"+duration, Toast.LENGTH_LONG).show();


            // Drawing polyline in the Google Map for the i-th route
            if(polylines.size()!=0) {
                polylines.get(0).remove();
            }
            Polyline line=mMap.addPolyline(lineOptions);
            polylines.add(0,line);
        }
    }

    /**
     * Obtain address from geocode
     * @param strUrl url for obtaining address
     * @return data that has been received
     * @throws IOException
     */
    private String downloadUrl(String strUrl) throws IOException {
        String data = "";
        InputStream iStream = null;
        HttpURLConnection urlConnection = null;
            try{
                URL url = new URL(strUrl);
                urlConnection = (HttpURLConnection) url.openConnection();
                urlConnection.connect();
                iStream = urlConnection.getInputStream();
                BufferedReader br = new BufferedReader(new InputStreamReader(iStream));
                StringBuffer sb  = new StringBuffer();
                String line = "";
                    while( ( line = br.readLine())  != null){
                     sb.append(line);
                    }
                data = sb.toString();
                br.close();
            }catch(Exception e){
                Log.d("Exception while downloading url", e.toString());
            }finally{
                iStream.close();
                urlConnection.disconnect();
            }
        return data;
    }

    /**
     *
     * @param origin Geo Code of pickup location
     * @param dest Geo code of destination
     * @return url for google maps directions api with geo codes embedded
     */
    private String getDirectionsUrl(LatLng origin, LatLng dest) {
        String str_origin = "origin="+origin.latitude+","+origin.longitude;
        String str_dest = "destination="+dest.latitude+","+dest.longitude;
        String sensor = "sensor=false";
        String parameters = str_origin+"&"+str_dest+"&"+sensor;
        String output = "json";
        String url = "https://maps.googleapis.com/maps/api/directions/"+output+"?"+parameters;
        return url;
    }
    ////////////////////////////////

    private class DrawerItemClickListener implements ListView.OnItemClickListener {
        @Override
        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
            selectItem(position);
        }

    }

    private void selectItem(int position) {
        Fragment fragment = null;

        switch (position) {
            case 0:
                Intent i = new Intent(RequestActivity.this, RequestActivity.class);
                startActivity(i);
                break;
            case 1:
                Intent j = new Intent(RequestActivity.this, HireActivity.class);
                startActivity(j);
                break;
            case 2:
                Intent n = new Intent(RequestActivity.this, ViewPassenger.class);
                startActivity(n);
                break;
            case 3:
                Intent m = new Intent(RequestActivity.this, FavouriteList.class);
                startActivity(m);
                break;
            default:
                break;
        }

        if (fragment != null) {
            FragmentManager fragmentManager = getFragmentManager();
            fragmentManager.beginTransaction().replace(R.id.content_frame, fragment).commit();

            mDrawerList.setItemChecked(position, true);
            mDrawerList.setSelection(position);
            getSupportActionBar().setTitle(mNavigationDrawerItemTitles[position]);
            mDrawerLayout.closeDrawer(mDrawerList);

        } else {
            Log.e("MapsActivity", "Error in creating fragment");
        }
    }
    /////////////////////////////////

}
