package com.example.pathum.mycabpickme;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.ActionBarDrawerToggle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class HireActivity extends ActionBarActivity {

    JSONParser jsonP=new JSONParser();


    private ArrayList<hire> hires;
    ListView hireList;

    ////////////////////////////////////////////////////////////////////
    private String[] mNavigationDrawerItemTitles;
    private DrawerLayout mDrawerLayout;
    private ListView mDrawerList;
    ActionBarDrawerToggle mDrawerToggle;
    private CharSequence mDrawerTitle;
    private CharSequence mTitle;
    String email;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hire);
      ///////////////////////////////////////////////////
        mTitle = mDrawerTitle = getTitle();
        mNavigationDrawerItemTitles= getResources().getStringArray(R.array.navigation_drawer_items_array);
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerList = (ListView) findViewById(R.id.left_drawer);
        ObjectDrawerItem[] drawerItem = new ObjectDrawerItem[4];

        drawerItem[0] = new ObjectDrawerItem(R.drawable.ic_home, "Book Now");
        drawerItem[1] = new ObjectDrawerItem(R.drawable.ic_trip, "My Trips");
        drawerItem[2] = new ObjectDrawerItem(R.drawable.ic_profile, "Profile");
        drawerItem[3] = new ObjectDrawerItem(R.drawable.ic_heart, "Favourites");
        DrawerItemCustomAdapter adapter = new DrawerItemCustomAdapter(this, R.layout.listview_item_row, drawerItem);
        mDrawerList.setAdapter(adapter);
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
        ///////////////////////////////////////////////////////
        hireList=(ListView)findViewById(R.id.listHires);
        hires=new ArrayList<hire>();
        new GetHires().execute();

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

   class GetHires extends AsyncTask<String, String, String> {
        boolean failure = false;
        /**
         * Before starting background thread Show Progress Dialog
         */
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

                SharedPreferences mySharedPreferences ;
                mySharedPreferences=getSharedPreferences("MyPrefs",0);
                email= mySharedPreferences.getString("email","");
                List<NameValuePair> params = new ArrayList<NameValuePair>();
                params.add(new BasicNameValuePair("email", email));
                JSONObject json =jsonP.makeHttpRequest(ApplicationConstants.FETCH_HIRES_URL, "POST", params);
                Log.d("Fetch vehicle attempt", json.toString());
                success = json.getInt(ApplicationConstants.TAG_SUCCESS);

                if (success == 1) {
                    try {

                        if (json != null) {
                            JSONArray categories = json.getJSONArray("hires");

                            for (int i = 0; i < categories.length(); i++) {
                                JSONObject catObj = (JSONObject) categories.get(i);
                                hire hi = new hire(catObj.getString("Timestamp"),
                                        catObj.getString("Pickup_Location"),
                                        catObj.getString("Destination"),
                                        catObj.getString("status"),
                                        catObj.getString("vehicle_type"),
                                        catObj.getInt("Request_ID")

                                            );
                                Log.d("Adding hires", catObj.getString("Pickup_Location"));
                                hires.add(hi);

                            }
                        }
                    }
                    catch (JSONException e) {
                        e.printStackTrace();
                    }
                    Log.d("Vehicles Recieved!", json.toString());
                    //finish();
                    return json.getString(ApplicationConstants.TAG_MESSAGE);
                }else{
                    Log.d("Error!", json.getString(ApplicationConstants.TAG_MESSAGE));
                    return json.getString(ApplicationConstants.TAG_MESSAGE);

                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }



        @Override
        protected void onPostExecute(String file_url){
            // dismiss the dialog once product deleted

            if (file_url != null){
                Toast.makeText(HireActivity.this, file_url, Toast.LENGTH_LONG).show();
            }
            populateList();

        }
        @Override
        protected void onProgressUpdate(String... values) {
            // super.onProgressUpdate(values);


        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_hire, menu);
        return true;
    }


    private void populateList() {
        List<hire> lables = new ArrayList<hire>();



        for (int i = 0; i < hires.size(); i++) {
           // lables.add("Hire "+(i+1));
            lables.add(hires.get(i));
            //lables.add(hires.get(i).getDestination());
           // lables.add(hires.get(i).getStatus());
            //lables.add(hires.get(i).getTimestamp());
            //lables.add(hires.get(i).getType());


        }

      //  ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
        //        android.R.layout.simple_list_item_1, lables);

        CustomListAdapter adapter=new CustomListAdapter(this, lables,email);

      hireList.setAdapter(adapter);
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
                Intent i = new Intent(HireActivity.this, RequestActivity.class);
                startActivity(i);
                break;
            case 1:
                Intent j = new Intent(HireActivity.this, HireActivity.class);
                startActivity(j);
                break;
            case 2:

                break;
            case 3:
                Intent m = new Intent(HireActivity.this, FavouriteList.class);
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
