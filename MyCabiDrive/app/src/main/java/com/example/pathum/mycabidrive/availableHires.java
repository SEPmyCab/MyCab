package com.example.pathum.mycabidrive;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by hp on 11/8/2015.
 */
public class availableHires extends Activity {


    JSONParser jsonParser = new JSONParser();
    private String jsonResult;
    private String url = "http://cabeelk.com/myCab2/fdg1.php";

    private ListView listView;
    String mString;

    EditText inputSearch;
    TextView tv1;
    SimpleAdapter simpleAdapter;
    static String[] tokens;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delete_hire);

       // inputSearch = (EditText) findViewById(R.id.inputSearch);
        listView = (ListView) findViewById(R.id.listView1);
        accessWebService();
        tv1= (TextView) findViewById(R.id.TV_u2);
        SharedPreferences mySharedPreferences ;

        final Intent intent = getIntent();
        mString= intent.getStringExtra("user");
        tv1.setText(mString);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                HashMap<String,String> map =(HashMap<String,String>)listView.getItemAtPosition(position);
                try {

                    String x =map.get("employees").toString();
                    tokens = x.split("[-]");
                    Intent t = new Intent(availableHires.this, deletehire.class);
                    t.putExtra("user",mString);
                    t.putExtra("destination",tokens[0]);
                    startActivity(t);

                }
                catch(Exception e){
                    Log.d("",e.toString());
                }
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_list, menu);
        return true;
    }

    // Async Task to access the web
    private class JsonReadTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... params) {
       //     HttpClient httpclient = new DefaultHttpClient();
      //      HttpPost httppost = new HttpPost(params[0]);
            Log.d("request!", mString);
            try {

                List<NameValuePair> param = new ArrayList<NameValuePair>();

                param.add(new BasicNameValuePair("Uname",mString));

                JSONObject json = jsonParser.makeHttpRequest(url, "POST", param);

          //      HttpResponse response = httpclient.execute(httppost);
                jsonResult = json.toString();
               
            }

            catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }

        private StringBuilder inputStreamToString(InputStream is) {
            String rLine = "";
            StringBuilder answer = new StringBuilder();
            BufferedReader rd = new BufferedReader(new InputStreamReader(is));

            try {
                while ((rLine = rd.readLine()) != null) {
                    answer.append(rLine);
                }
            }

            catch (IOException e) {
                // e.printStackTrace();
                Toast.makeText(getApplicationContext(),
                        "Error..." + e.toString(), Toast.LENGTH_LONG).show();
            }
            return answer;
        }

        @Override
        protected void onPostExecute(String result) {
            ListDrwaer();


        }
    }// end async task

    public void accessWebService() {
        JsonReadTask task = new JsonReadTask();
        Log.d("URL IS :", url);
        // passes values for the urls string array
        task.execute(new String[] { url });

    }

    // build hash set for list view
    public void ListDrwaer() {
        List<Map<String, String>> employeeList = new ArrayList<Map<String, String>>();

        try {

            JSONObject jsonResponse = new JSONObject(jsonResult);
            JSONArray jsonMainNode = jsonResponse.optJSONArray("emp_info");

            for (int i = 0; i < jsonMainNode.length(); i++) {
                JSONObject jsonChildNode = jsonMainNode.getJSONObject(i);
                String name = jsonChildNode.optString("Destination");
                String number = jsonChildNode.optString("Passenger_ID");
                String certify=jsonChildNode.optString("Certification");
                String outPut = name + "-" + number;
                employeeList.add(createEmployee("employees", outPut));
            }


        } catch (JSONException e) {
            Toast.makeText(getApplicationContext(), "Error" + e.toString(),
                    Toast.LENGTH_LONG).show();
        }

        simpleAdapter = new SimpleAdapter(this, employeeList,
                android.R.layout.simple_list_item_1,
                new String[] { "employees" }, new int[] { android.R.id.text1 });
        listView.setAdapter(simpleAdapter);

    }

    private HashMap<String, String> createEmployee(String name, String number) {
        HashMap<String, String> employeeNameNo = new HashMap<String, String>();
        employeeNameNo.put(name, number);
        return employeeNameNo;
    }



}

