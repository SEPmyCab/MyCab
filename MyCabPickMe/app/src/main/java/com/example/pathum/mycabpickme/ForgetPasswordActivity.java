package com.example.pathum.mycabpickme;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

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
import javax.mail.Session;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

public class ForgetPasswordActivity extends ActionBarActivity implements View.OnClickListener {

    private ProgressDialog pDialog;
    EditText recoveryEmailField;
    String recoveryEmail;
    String phoneNo;
    String password;

    JSONParser jsonParser = new JSONParser();
    private static final String RECOVERY_URL = "http://cabeelk.com/myCab2/pforgetpassword.php";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forget_password);
        getSupportActionBar().hide();

        recoveryEmailField=(EditText)findViewById(R.id.ET_recoveryeEmail);

    }

    //Background thread creation for net based activities
    class Recover extends AsyncTask<String, String, String>{

        @Override
        protected void onProgressUpdate(String... values) {
            super.onProgressUpdate(values);
        }

        @Override
        protected void onPostExecute(String file_url) {
            pDialog.dismiss();
            if (file_url != null){
                Toast.makeText(ForgetPasswordActivity.this, file_url, Toast.LENGTH_LONG).show();
            }

        }

        //Progressbar messages
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(ForgetPasswordActivity.this);
            pDialog.setMessage("Recovering Password...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(true);
            pDialog.show();
        }

        //Background thread
        @Override
        protected String doInBackground(String... params) {

            int success; //Success Flag

            recoveryEmail=recoveryEmailField.getText().toString();

            try{

            List<NameValuePair> params1 = new ArrayList<NameValuePair>();

            params1.add(new BasicNameValuePair("email", recoveryEmail));

            Log.d("request!", "starting");

            JSONObject json = jsonParser.makeHttpRequest(RECOVERY_URL, "POST", params1); //Sending parameters to server php file

            success = json.getInt(TAG_SUCCESS);

            if (success == 1) {

                password=json.getString("password");
                phoneNo=json.getString("phone");

                SendEmail(); //Call to email sending method
                sendSMS(); //Call to text message sending method

                Log.d("Recovery successful!!", json.toString());

                finish(); //Finish forget password activity

                return json.getString(TAG_MESSAGE);

            } else {
                Log.d("Recovery Check Failure!", json.getString(TAG_MESSAGE));
                return json.getString(TAG_MESSAGE);
            }

         } catch (JSONException e) {
                e.printStackTrace();
            } catch (Exception e) {
                e.printStackTrace();
            }

            return null;
        }
    }



    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_forget_password, menu);
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

    //Text message sending method
    public void sendSMS(){

        String message="MyCab PickMe login details.\nEmail: "+recoveryEmail+"\nPassword: "+password+"\n"; //Text message body
        SmsManager sms = SmsManager.getDefault(); //Initialize android inbuilt sms service
        sms.sendTextMessage(phoneNo, null, message, null, null); //Setup text message
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
                InternetAddress.parse(recoveryEmail, false)); //Receivers's email
        msg.setSubject("MyCab Password Recovery"); //Email topic
        msg.setText("MyCab PickMe Mobile App.\nDon't forget your login details.\n\nEmail: " + recoveryEmail + "\nPassword: " + password + "\n\n MyCab© PickMe© All Rights Reserved."); //Email body
        msg.setSentDate(new Date());
        SMTPTransport t =
                (SMTPTransport)session.getTransport("smtps");
        t.connect("smtp.mailgun.com", "postmaster@sandboxf9d48201d3744125aa9850e51a156f2f.mailgun.org", "a3532c63a43d55f68b8dc6f881d2008e");  //Mail server login details
        t.sendMessage(msg, msg.getAllRecipients());
        System.out.println("Response: " + t.getLastServerResponse());
        t.close();
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.B_recover:
                new Recover().execute();
                break;
            case R.id.B_recoverGoBack:
                finish();
                break;

        }
    }
}
