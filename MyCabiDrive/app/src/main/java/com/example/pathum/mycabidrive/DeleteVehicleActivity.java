package com.example.pathum.mycabidrive;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class DeleteVehicleActivity extends ActionBarActivity implements View.OnClickListener{
EditText regno;
    EditText nic;
    private ProgressDialog pDialog;
    JSONParser jsonParser = new JSONParser();

    private static final String DELETE_VEHICLE_URL = "http://blinkcab.host56/myCab2/delete_vehicle.php";
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_delete_vehicle);
        regno=(EditText)findViewById(R.id.ET_Reg_Nod);
        nic=(EditText)findViewById(R.id.ET_NICd);

    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_delete_vehicle, menu);
        return true;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.B_delete_vehicle:
                new AlertDialog.Builder(this)
                        .setTitle("Delete vehicle")
                        .setMessage("Are you sure you want to delete this vehicle?")
                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                               new DeleteVehicle().execute();
                            }
                        })
                        .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                               dialog.dismiss();
                            }
                        })
                        .setIcon(android.R.drawable.ic_dialog_alert)
                        .show();
                break;
        }
        
    }

    class DeleteVehicle extends AsyncTask<String, String, String> {
        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(DeleteVehicleActivity.this);
            pDialog.setMessage("Deleting Vehicles...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        protected String doInBackground(String... arg0) {

            int success;


            String Regno = regno.getText().toString();
            String NIC = nic.getText().toString();






            try {
                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("regno", Regno));
                params.add(new BasicNameValuePair("nic", NIC));

                Log.d("request!", "starting");

                JSONObject json1 = jsonParser.makeHttpRequest(DELETE_VEHICLE_URL, "POST", params);

                Log.d("Save attempt", json1.toString());

                success = json1.getInt(TAG_SUCCESS);
                if (success == 1) {
                    Log.d("Changed are Saved!", json1.toString());
                    Intent intent = new Intent(DeleteVehicleActivity.this, MainActivity.class);

                    finish();
                    startActivity(intent);
                    return json1.getString(TAG_MESSAGE);


                } else {
                    Log.d("Cannot Save Changes!", json1.getString(TAG_MESSAGE));
                    return json1.getString(TAG_MESSAGE);
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(DeleteVehicleActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
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
