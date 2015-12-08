/**
 * Created by Nu on 8/25/2015.
 */
package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.os.Handler;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class AlertActivity extends ActionBarActivity implements View.OnClickListener{
    private final static int PLAY_SERVICES_RESOLUTION_REQUEST = 9000;
    TextView msgET, usertitleET;
    Button start;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
       // Thread.setDefaultUncaughtExceptionHandler(new ExceptionHandler(this));
        setContentView(R.layout.activity_alert);
        // Intent Message sent from Broadcast Receiver
        String str = getIntent().getStringExtra("msg");
        // Get first Name from Shared preferences
        SharedPreferences prefs = getSharedPreferences("MyPrefs",Context.MODE_PRIVATE);
        String fName = prefs.getString("fname", "");
        // Set Title
        usertitleET = (TextView) findViewById(R.id.usertitle);
        start=(Button)findViewById(R.id.buttonStart);
        // Check if Google Play Service is installed in Device
        if (!checkPlayServices()) {
            Toast.makeText(
                    getApplicationContext(),
                    "This device doesn't support Play services, App will not work normally",
                    Toast.LENGTH_LONG).show();
        }
        usertitleET.setText("Hello " + fName + " !");
        if (str != null) {
            // Set the message received from server in the TextView
            msgET = (TextView) findViewById(R.id.message);
            Log.e("string",str);
            msgET.setText(str);

            if(str.startsWith("No"))
            {
                start.setVisibility(View.GONE);
            }



        }
        start.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent m = new Intent(AlertActivity.this, startHire.class);
                startActivity(m);
            }
        });
    }

    @Override
    public void onClick(View v) {
        switch(v.getId())
        {
        }
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /**
     * check if the device support play services
     * @return boolean
     */
    private boolean checkPlayServices() {
        try {
            int resultCode = GooglePlayServicesUtil
                    .isGooglePlayServicesAvailable(this);
            // When Play services not found in device
            if (resultCode != ConnectionResult.SUCCESS) {
                if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {
                    // Show Error dialog to install Play serviceskl
                    GooglePlayServicesUtil.getErrorDialog(resultCode, this, PLAY_SERVICES_RESOLUTION_REQUEST).show();
                } else {
                    Toast.makeText(
                            getApplicationContext(),
                            "This device doesn't support Play services, App will not work normally",
                            Toast.LENGTH_LONG).show();
                    finish();
                }
                return false;
            } else {
                Toast.makeText(
                        getApplicationContext(),
                        "This device supports Play services, App will work normally",
                        Toast.LENGTH_LONG).show();
            }
            return true;
        } catch (Exception e) {
            Toast.makeText(
                    getApplicationContext(),
                    "Error Occurred with location services!",
                    Toast.LENGTH_LONG).show();
            return  false;
        }

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_alert, menu);
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
