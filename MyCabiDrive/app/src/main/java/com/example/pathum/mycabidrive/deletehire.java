package com.example.pathum.mycabidrive;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by hp on 11/8/2015.
 */
public class deletehire extends Activity implements View.OnClickListener{


    private ProgressDialog pDialog;
    JSONParser jsonParser = new JSONParser();
    public static String user;
    public static String destination;
    TextView userName;
    TextView destination1;
    Button decline;
    Button cancel;
    private static final String url2= "http://cabeelk.com/myCab2/updateStatus.php";
    private static final String TAG_SUCCESS= "success";
    private static final String TAG_MESSAGE= "message";
   // final AlertDialog.Builder dlgAlert  = new AlertDialog.Builder(this);
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_deletehire);

        final Intent intent = getIntent();
        user = intent.getStringExtra("user");
        destination=intent.getStringExtra("destination");
        userName= (TextView) findViewById(R.id.TV_usr);
        destination1= (TextView) findViewById(R.id.TV_desti);
        userName.setText(user);
        destination1.setText(destination);

     Log.d("dfdfdf",destination);
    }

    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up buttonY, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void onClick(View v){
        switch (v.getId()){
            case R.id.B_delete_hire:
                Log.d("clickkkked","decline");
                new AlertDialog.Builder(this)
                        .setTitle("Delete vehicle")
                        .setMessage("Are you sure you want to delete this hire?")
                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                                new DeleteHire().execute();
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

    class DeleteHire extends AsyncTask<String, String, String> {
        boolean failure = false;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(deletehire.this);
            pDialog.setMessage("Deleting Hire.....");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        protected String doInBackground(String... arg0) {

            int success;
            String x=userName.getText().toString();
            String y=destination1.getText().toString();

            try {
                List<NameValuePair> params = new ArrayList<NameValuePair>();
                params.add(new BasicNameValuePair("user", x));
                params.add(new BasicNameValuePair("destination", y));

                Log.d("request!", "starting");
                JSONObject json1 = jsonParser.makeHttpRequest(url2, "POST", params);
                Log.d("Save attempt", json1.toString());
                Log.d("Changed are Saved!", json1.toString());
                Toast.makeText(deletehire.this,"Successfully declined..",Toast.LENGTH_LONG).show();
                Intent intent = new Intent(deletehire.this, MainActivity.class);
                finish();
                startActivity(intent);
                return json1.getString(TAG_MESSAGE);

            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(deletehire.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
    }





}
