package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
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
    private static final String FETCH_HIRES_URL = "http://blinkcab.host56.com/myCab2/fetch_hires.php";

    private ArrayList<hire> hires;
    ListView hireList;
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hire);
        hireList=(ListView)findViewById(R.id.listHires);
        hires=new ArrayList<hire>();
        new GetHires().execute();
    }

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
                String email= mySharedPreferences.getString("email","");
                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("email", email));




                JSONObject json =jsonP.makeHttpRequest(FETCH_HIRES_URL, "POST", params);



                Log.d("Fetch vehicle attempt", json.toString());



                success = json.getInt(TAG_SUCCESS);

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
                                        catObj.getString("vehicle_type"));
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
    private void populateList() {
        List<String> lables = new ArrayList<String>();



        for (int i = 0; i < hires.size(); i++) {
            lables.add("Hire "+(i+1));
            lables.add(hires.get(i).getPickup());
            lables.add(hires.get(i).getDestination());
            lables.add(hires.get(i).getStatus());
            lables.add(hires.get(i).getTimestamp());
            lables.add(hires.get(i).getType());


        }

        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
                android.R.layout.simple_list_item_1, lables);



      hireList.setAdapter(adapter);
    }
}
