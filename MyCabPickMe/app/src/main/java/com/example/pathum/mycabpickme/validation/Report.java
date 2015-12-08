package com.example.pathum.mycabpickme.validation;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import com.example.pathum.mycabpickme.JSONParser;
import com.example.pathum.mycabpickme.R;
import com.example.pathum.mycabpickme.properties;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Report extends ActionBarActivity implements View.OnClickListener{

    RadioGroup rdo_RadioGroup;
    RadioButton rdo_DriveHighSpeed;
    RadioButton rdo_PlayLoudMusic;
    RadioButton rdo_Other;
    RadioButton rdo_Offence;
    RadioButton rdo_ChainHorning;
    RadioButton rdo_DrunkDrive;
    RadioButton rdo_HighSpeed;

    Button btn_ReportDrive;
    Button btn_ReportDCance;

    EditText tf_Comment;

    String Message;
    String report;
    String reportComments;

    int Status;

    private ProgressDialog pDialog;

    List<NameValuePair> args=new ArrayList<NameValuePair>();
    
    JSONParser jsonParser = new JSONParser();


    /**
     * class variables declare in here
     *
     * @return 1 for successful -1 for else
     *
     * @exception NullPointerException
     *
     * @exception NumberFormatException
     *
     * @exception Exception handle any exception
     *
     */
    public int declareVariables(){

        try {

            rdo_RadioGroup= (RadioGroup) findViewById(R.id.RadioGrp);
            rdo_DriveHighSpeed = (RadioButton) findViewById(R.id.rdo_DrSpd);
            rdo_PlayLoudMusic = (RadioButton) findViewById(R.id.rdo_PlLoMu);
            rdo_Other = (RadioButton) findViewById(R.id.rdo_Othr);
            rdo_Offence = (RadioButton) findViewById(R.id.rdo_Offence);
            rdo_ChainHorning = (RadioButton) findViewById(R.id.rdo_ChHor);
            rdo_DrunkDrive = (RadioButton) findViewById(R.id.rdo_DnkDr);
            rdo_HighSpeed = (RadioButton) findViewById(R.id.rdo_TrHiSpd);
            tf_Comment = (EditText) findViewById(R.id.ET_comments);
            rdo_RadioGroup = (RadioGroup) findViewById(R.id.RadioGrp);
            btn_ReportDrive = (Button) findViewById(R.id.btn_Report);
            btn_ReportDCance = (Button) findViewById(R.id.btn_cancel);


        }catch(NullPointerException nullpointexception){

            Log.e("declaring Error", "Error converting result " + nullpointexception.toString());

        }catch(NumberFormatException numberformatexception){

            Log.e("declaring Error", "Error converting result " + numberformatexception.toString());

        }catch(Exception exception){

            Log.e("declaring Error", "Error converting result " + exception.toString());

        }finally {

            Log.e("declaring finall", "declaring finall ");

        }
        return -1;
    }



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_report);
        declareVariables();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_report, menu);
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


    /**
     * This method used to call ReportDriver background thread
     *
     * Verify Report method and get value from radio buttons
     *
     * This method used to map values with properties class
     *
     * @exception NullPointerException
     *
     * @exception ArrayIndexOutOfBoundsException
     *
     * @exception IndexOutOfBoundsException
     *
     *      if (reportComments.isEmpty() if report field is empty : Toast and Highlight field
     *
     *
     */
    public void reportDriverMethod(){

        try {

            if (rdo_DriveHighSpeed.isChecked()) {

                report = properties.DRIVE_SPEED;

            } else if (rdo_PlayLoudMusic.isChecked()) {

                report = properties.PLAY_LOUD_MUSIC;

            } else if (rdo_Offence.isChecked()) {

                report = properties.OFFENCES;

            } else if (rdo_ChainHorning.isChecked()) {

                report = properties.CHAIN_HORNING;

            } else if (rdo_DrunkDrive.isChecked()) {

                report = properties.DRUNK_AND_DRIVE;

            } else if (rdo_HighSpeed.isChecked()) {

                report = properties.TRAVEL_HIGH_SPEED;

            } else {

                report = properties.OTHER;

            }

            reportComments = tf_Comment.getText().toString();

            if (reportComments.isEmpty()){

                Toast.makeText(getApplicationContext(), "Please fill the comments field", Toast.LENGTH_LONG).show();

                tf_Comment.setBackgroundColor(Color.RED);

            } else {

                new ReportDriver().execute();

            }
        }catch (NullPointerException nullpointerexception){


        }catch (ArrayIndexOutOfBoundsException arrayindexoutofboundry){


        }catch (IndexOutOfBoundsException indexoutofboundexception){


        }finally {

        }
    }

    /**
     * This method used to make popup message
     *
     */
    public void showAlert(){
        new AlertDialog.Builder(this)
                .setIcon(android.R.drawable.ic_dialog_alert)
                .setTitle("Cancel")
                .setMessage("Are you sure you want to cancel?")
                .setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }

                })
                .setNegativeButton("No", null)
                .show();
    }
    /**
     * This method used to handle onClick events for class
     *
     * @param view Android View
     *
     * @Exception NullPointerException
     *
     * @Exception Exception
     *
     */
    @Override
    public void onClick(View view) {

        switch (view.getId()){

            case R.id.btn_Report:
                reportDriverMethod();
                break;

            case R.id.btn_cancel:
                showAlert();
                break;
        }
    }

    /**
     * This method used to run asyntask background activity
     *
     * Background Thread
     *
     * Fetching Rating Details to WebService
     *
     * @OnPreExecute : assign values,start progress bar activity
     *
     * @DoInBackground: fetching data
     *
     * @OnPostExecute: stop progress bar activity,stop thread
     *
     */
    public class ReportDriver extends AsyncTask<String,String,String> {

        @Override
        protected String doInBackground(String... params) {

            /*
             *here user name get from home page
             * pathum watch here
             */
            String username="saman";

            try{
                args.add(new BasicNameValuePair("reportComments", reportComments));
                args.add(new BasicNameValuePair("report", report));
                args.add(new BasicNameValuePair("uname",username));
                JSONObject jsonobject=jsonParser.makeHttpRequest(properties.REPORT_DRIVER, "POST", args);
                Status = jsonobject.getInt("sucess");
                Message=jsonobject.get("message").toString();

            }catch (JSONException e){

            }catch (NullPointerException nullpointerexception){

            }catch(Exception exception){

            } finally {

            }

            return null;
        }

        @Override
        protected void onPreExecute() {

            super.onPreExecute();
            pDialog = new ProgressDialog(Report.this);
            pDialog.setMessage("Fetching Data...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }

        @Override
        protected void onPostExecute(String s) {

            super.onPostExecute(s);

            pDialog.dismiss();

            if (Status==1){

                Toast.makeText(getApplicationContext(), "Successfully Updated ....", Toast.LENGTH_LONG).show();

            }else if(Status==0){

                Toast.makeText(getApplicationContext(),"Successfully Updated ....",Toast.LENGTH_LONG).show();

            }
        }
    }
}
