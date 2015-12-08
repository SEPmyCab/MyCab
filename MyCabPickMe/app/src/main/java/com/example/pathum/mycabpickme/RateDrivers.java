package com.example.pathum.mycabpickme;

import android.app.ProgressDialog;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RatingBar;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class RateDrivers extends ActionBarActivity implements View.OnClickListener {

    private ProgressDialog pDialog;
    String Message;
    String ratings;
    String ratingComment;
    int Status;
    Button submit;
    EditText comment;
    RatingBar Ratings;
    JSONParser jsonParser = new JSONParser();
    List<NameValuePair> args=new ArrayList<NameValuePair>();



    /**
     * This method used to declare class level attributes
     * Layout RateDriver_layout
     *
     * @return No return type
     *
     *
     */
    public void declareVariables(){

        //submit button report driver layout
        submit= (Button) findViewById(R.id.btn_rateSubmit);

        //comment edit text area report driver layouts
        comment= (EditText) findViewById(R.id.tf_rateComment);

        //rating bar report driver layouts
        Ratings= (RatingBar) findViewById(R.id.rb_rating);
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_rate_drivers);

        //declare variables
        declareVariables();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {

        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_rate_drivers, menu);

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
     * This method used do call rate driver Asyntask,
     *
     * checking comment field if comments are not available give toast and highlight
     *          if (comment.getText() == null) : make Toast
     *          else rateDriver Background Thread
     *
     * @Exception NullPointerException  comment.getText() can be null
     *
     * @Exception Exception
     *
     */
    public void rateDrivers(){

        try {
            if (comment.getText() == null) {

                Toast.makeText(getApplicationContext(), "Please fill the review column", Toast.LENGTH_LONG).show();

                //review column getting highlight when its empty
                comment.setBackgroundColor(Color.RED);

            } else {

                new rateDrivers().execute();

            }
        }catch (NullPointerException nullpointerexception){


        }catch (Exception exception){


        }
    }

    /**
     * This method used to handle onClick events for class
     *
     * @param view Android View
     *
     * @Exception NullPointerException
     *
     * @exception Exception
     *
     */
    @Override
    public void onClick(View view) {

        try {
            switch (view.getId()) {

                case R.id.btn_rateSubmit:
                    rateDrivers();
                    break;
            }
        }catch (NullPointerException nullpointerexception){

        }catch (Exception exception){

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
    public class rateDrivers extends AsyncTask<String, String, String> {

        @Override
        protected String doInBackground(String... params) {

            /*
             *get @username from Home Page
             * pathum watch here
             */
            String username = "saman";
            args.add(new BasicNameValuePair("RatingComments",ratingComment));
            args.add(new BasicNameValuePair("rating", ratings));
            args.add(new BasicNameValuePair("uname",username));


            JSONObject jsonobject = jsonParser.makeHttpRequest(properties.RATE_DRIVER, "POST", args);

            try {
                Status = jsonobject.getInt("sucess");
                Message = jsonobject.get("message").toString();

            } catch (JSONException e) {

                System.out.println("JSONE Error : " + e);

            } catch (NullPointerException nullpointerexception) {

            } catch (Exception exception) {

            } finally {

            }

            return null;
        }

        @Override
        protected void onPreExecute() {

            super.onPreExecute();
            pDialog = new ProgressDialog(RateDrivers.this);
            pDialog.setMessage("Updating");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
            ratings=String.valueOf(Ratings.getRating());
            ratingComment=comment.getText().toString();

        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pDialog.dismiss();
            if (Status == 1) {

                Toast.makeText(getApplicationContext(), "Successfully Updated ....", Toast.LENGTH_LONG).show();

            } else if (Status == 0) {

                Toast.makeText(getApplicationContext(), "Updating Error ..", Toast.LENGTH_LONG).show();

            }
        }
    }

}