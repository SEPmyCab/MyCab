package com.example.pathum.mycabpickme;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.ContactsContract;
import android.support.v7.app.ActionBarActivity;
import android.telephony.SmsManager;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.WebResource;
import com.sun.jersey.api.client.filter.HTTPBasicAuthFilter;
import com.sun.jersey.core.util.MultivaluedMapImpl;
import com.sun.mail.smtp.SMTPTransport;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.internet.AddressException;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import javax.ws.rs.core.MediaType;


public class RegisterActivity extends ActionBarActivity implements View.OnClickListener  {

    private ProgressDialog pDialog;

    EditText fnameField;
    EditText lnameField;

    EditText passwordField;
    EditText conpwdField;
    EditText emailField;
    EditText phoneField;

    public String Phone;
    public String Email;
    public String Pwd;


    JSONParser jsonParser = new JSONParser();
    private static final String LOGIN_URL = "http://cabeelk.com/myCab2/pregister.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        getSupportActionBar().hide();

        fnameField = (EditText) findViewById(R.id.ET_FirstName);
        lnameField = (EditText) findViewById(R.id.ET_LastName);
        emailField=(EditText)findViewById(R.id.ET_email);
        passwordField = (EditText) findViewById(R.id.ET_Password);
        conpwdField=(EditText)findViewById(R.id.ET_ConPassword);
        phoneField = (EditText) findViewById(R.id.ET_PhoneNo);



    }

    @Override
    public void onClick(View v) {
        switch(v.getId())
        {

            case R.id.B_register:
                new CreateNewPassenger().execute(); //Execution of register thread
                break;
            case R.id.B_registerGoBack:
                finish(); //Finish register activity on go back button pressed
                break;
        }
    }

    //Background thread creation for net based activities
    class CreateNewPassenger extends AsyncTask<String, String, String> {

        //Progressbar messages
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(RegisterActivity.this);
            pDialog.setMessage("Registering Passenger...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }


        //Background thread
        protected String doInBackground(String... arg0) {

            int success; //Success Flag

            String Fname = fnameField.getText().toString();
            String Lname = lnameField.getText().toString();
            Email=emailField.getText().toString();
            Pwd = passwordField.getText().toString();
            String cPwd=conpwdField.getText().toString();
            Phone=phoneField.getText().toString();


            try {

                List<NameValuePair> params = new ArrayList<NameValuePair>();

                params.add(new BasicNameValuePair("fname", Fname));
                params.add(new BasicNameValuePair("lname", Lname));
                params.add(new BasicNameValuePair("email",Email));
                params.add(new BasicNameValuePair("password", Pwd));
                params.add(new BasicNameValuePair("phone", Phone));
                params.add(new BasicNameValuePair("cpwd", cPwd));

                Log.d("request!", "starting");

                JSONObject json = jsonParser.makeHttpRequest(LOGIN_URL, "POST", params); //Sending parameters to server php file

                Log.d("Register attempt", json.toString());

                success = json.getInt(TAG_SUCCESS);

                if (success == 1) {

                    SendEmail(); //Call to email sending method
                    sendSMS();   //Call to text message sending method

                    Log.d("Passenger Created!", json.toString());

                    finish(); //Finish register activity

                    return json.getString(TAG_MESSAGE);

                } else {

                    Log.d("Registration Failure!", json.getString(TAG_MESSAGE));
                    return json.getString(TAG_MESSAGE);

                }
            } catch (JSONException e) {
                e.printStackTrace();
            } catch (Exception e) {
                e.printStackTrace();
            }

            return null;

        }


        protected void onPostExecute(String file_url) {

            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(RegisterActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }
        @Override
        protected void onProgressUpdate(String... values) {
            super.onProgressUpdate(values);

        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_activity_register, menu);
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

    //Text message sending method
    public void sendSMS(){

        String message="MyCab PickMe login details.\nEmail: "+Email+"\nPassword: "+Pwd+"\n"; //Text message body
        SmsManager sms = SmsManager.getDefault(); //Initialize android inbuilt sms service
        sms.sendTextMessage(Phone, null, message, null, null); //Setup text message
    }

    //Email sending method
    public void SendEmail() throws Exception {

        Properties props = System.getProperties();
        props.put("mail.smtps.host","smtp.mailgun.org");
        props.put("mail.smtps.auth","true");
        Session session = Session.getInstance(props, null);
        Message msg = new MimeMessage(session);
        msg.setFrom(new InternetAddress("\n" +
                "MyCab PickMe<braviajones@gmail.com>")); //Sender's email
        msg.setRecipients(Message.RecipientType.TO,
                InternetAddress.parse(Email, false));  //Receivers's email
        msg.setSubject("MyCab Registration Successful"); //Email topic
        msg.setText("You are successfully registered with MyCab PickMe Mobile App.\nDon't forget your login details.\n\nEmail: " + Email + "\nPassword: " + Pwd + "\n\n MyCab© PickMe© All Rights Reserved."); //Email body
        msg.setSentDate(new Date());
        SMTPTransport t =
                (SMTPTransport)session.getTransport("smtps");
        t.connect("smtp.mailgun.com", "postmaster@sandboxf9d48201d3744125aa9850e51a156f2f.mailgun.org", "a3532c63a43d55f68b8dc6f881d2008e"); //Mail server login details
        t.sendMessage(msg, msg.getAllRecipients());
        System.out.println("Response: " + t.getLastServerResponse());
        t.close();

    }

    //Method to confirm exit on back button pressed
    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(android.R.drawable.ic_dialog_alert)
                .setTitle("EXIT")
                .setMessage("Are you sure you want to Exit?")
                .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }

                })
                .setNegativeButton("No", null)
                .show();
    }



}
