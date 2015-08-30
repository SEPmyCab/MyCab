package com.example.pathum.mycabidrive;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class AddVehicleActivity extends ActionBarActivity implements View.OnClickListener {
Spinner typeField;
    Button btnreg;
    RadioGroup radioGroup;
    String AC;

    EditText ManuF;
    EditText ModelF;
    EditText RegNOF;
    EditText SeatsF;


    JSONParser jsonParser = new JSONParser();
    String mStringnic;

    private static final String LOGIN_URL = "http://blinkcab.host56.com/myCab2/add_vehicle.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";
    private ProgressDialog pDialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_vehicle);
        getSupportActionBar().hide();
        typeField = (Spinner) findViewById(R.id.SP_vehicle_Type);

        ManuF=(EditText)findViewById(R.id.ET_manu);
        ModelF=(EditText)findViewById(R.id.ET_model);
        RegNOF=(EditText)findViewById(R.id.ET_Reg_No);
        SeatsF=(EditText)findViewById(R.id.ET_seats);
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(AddVehicleActivity.this,R.array.vehicle_array, android.R.layout.simple_spinner_item);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        typeField.setAdapter(adapter);

        radioGroup=(RadioGroup)findViewById(R.id.radioGroup);

        radioGroup.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener()
        {
            public void onCheckedChanged(RadioGroup group, int checkedId) {

                RadioButton rb=(RadioButton)findViewById(checkedId);
                AC=rb.getText().toString();
                //Toast.makeText(getApplicationContext(), rb.getText(), Toast.LENGTH_SHORT).show();
            }
        });
        SharedPreferences mySharedPreferences ;
        mySharedPreferences=getSharedPreferences("MyPref",0);
        mStringnic= mySharedPreferences.getString("nic","");
    }

    @Override
    public void onClick(View v) {
        switch(v.getId()) {

            case R.id.B_add_vehicle:
                new AddVehicle().execute();
                break;
        }
    }

    class AddVehicle extends AsyncTask<String, String, String> {
        boolean failure = false;



        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(AddVehicleActivity.this);
            pDialog.setMessage("Adding Vehicle...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        protected String doInBackground(String... arg0) {

            int success;

            String Manu = ManuF.getText().toString();
            String Model = ModelF.getText().toString();

            String Seats= SeatsF.getText().toString();

            String NIC = mStringnic;

            String Regno = RegNOF.getText().toString();

            String Type=typeField.getSelectedItem().toString();



                try {
                    List<NameValuePair> params = new ArrayList<NameValuePair>();
                    params.add(new BasicNameValuePair("regno", Regno));
                    params.add(new BasicNameValuePair("type", Type));
                    params.add(new BasicNameValuePair("manu", Manu));
                    params.add(new BasicNameValuePair("model", Model));
                    params.add(new BasicNameValuePair("seats", Seats));
                    params.add(new BasicNameValuePair("ac", AC));
                    params.add(new BasicNameValuePair("nic", NIC));
                    params.add(new BasicNameValuePair("type", Type));
                    Log.d("request!", "starting");
                    //Posting user data to script
                    JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params);
                    // full json response
                    Log.d(" Attempt to add", json.toString());
                    // json success element
                    success = json.getInt(TAG_SUCCESS);
                    if (success == 1) {
                        Log.d("Vehicle Added!", json.toString());
                        finish();
                        return json.getString(TAG_MESSAGE);
                    } else {
                        Log.d("Cannot add vehicle", json.getString(TAG_MESSAGE));
                        return json.getString(TAG_MESSAGE);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }


            return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(AddVehicleActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_add_vehicle, menu);
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
