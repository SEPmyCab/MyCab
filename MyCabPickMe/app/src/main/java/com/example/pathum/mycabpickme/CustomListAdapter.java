package com.example.pathum.mycabpickme;

/**
 * Created by Nu on 10/13/15.
 */
import java.util.ArrayList;
import java.util.List;

import android.accounts.NetworkErrorException;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.NetworkError;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class CustomListAdapter extends BaseAdapter {
    private Activity activity;
    private LayoutInflater inflater;
    private List<hire> hireItems;
    private hire m;
    private hire mii;
    private String mEmail;
    private ArrayList<hire> hires =new ArrayList<>();
    private List<hire> lables = new ArrayList<hire>();
    JSONParser jsonParser = new JSONParser();
    public CustomListAdapter(Activity activity, List<hire> movieItems,String email) {
        this.activity = activity;
        this.hireItems = movieItems;
        this.mEmail=email;
    }

    @Override
    public int getCount() {
        return hireItems.size();
    }

    @Override
    public Object getItem(int location) {
        return hireItems.get(location);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    /**
     *This method generate item's view of a ListView
     * @param position position of ListView row
     * @param convertView view containing the ListView
     * @param parent parent view
     * @return view
     */
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final int po=position;
        ViewHolder holder;
        //takes your layout XML-files and creates different View-objects from its contents.
        if (inflater == null)
            inflater = (LayoutInflater) activity
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        //The adapters are built to reuse Views, when a View is scrolled so that is no longer visible,
        // it can be used for one of the new Views appearing. This reused View is the convertView.
        // If this is null it means that there is no recycled View and we have to create a new one,
        // otherwise we should use it to avoid creating a new.
        if (convertView == null)
            convertView = inflater.inflate(R.layout.list_row, null);
        holder=new ViewHolder();
        holder.No = (TextView) convertView.findViewById(R.id.no);
        holder.Pickup = (TextView) convertView.findViewById(R.id.pick);
        holder.Destination = (TextView) convertView.findViewById(R.id.dest);
        holder.Timestamp = (TextView) convertView.findViewById(R.id.time);
        holder.Status = (TextView) convertView.findViewById(R.id.status);
        holder.cancel=(Button)convertView.findViewById(R.id.buttonCancel);
        m = hireItems.get(position);
        holder.No.setText(String.valueOf(position+1));
        holder.Pickup.setText("Pickup: " + m.getPickup());
        holder.Destination.setText("Destination: " + m.getDestination());
        holder.Timestamp.setText(m.getTimestamp());
        holder.Status.setText(m.getStatus());
        Log.d("status",m.getStatus());
        Log.d("status",String.valueOf(m.getStatus()));
        if(m.getStatus().equals("Queued")|m.getStatus().equals("Your cab is on the way"))
            holder.cancel.setVisibility(View.VISIBLE);
        holder.cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(final View v) {
                final View view=v;
                AlertDialog.Builder alertDialog = new AlertDialog.Builder(v.getContext());
                alertDialog.setTitle("Confirm Cancellation");
                alertDialog.setMessage("Are you sure you want to cancel?");
                alertDialog.setIcon(R.drawable.delimg);
                alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        mii = hireItems.get(po);
                        MyTaskParams params = new MyTaskParams(mii,view);
                        try {
                            new CancelRequest().execute(params);
                        }catch (Exception e)
                        {
                            e.printStackTrace();
                        }
                        Intent i=new Intent(view.getContext(),HireActivity.class);
                        view.getContext().startActivity(i);
                    }
                });
                alertDialog.setNegativeButton("NO",new DialogInterface.OnClickListener(){
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Intent i=new Intent(view.getContext(),HireActivity.class);
                        view.getContext().startActivity(i);
                    }
                });
                AlertDialog alert = alertDialog.create();
                alert.show();
           }
        });
        return convertView;
    }

    /**
     *Refresh listview
     * @param results new hire list
     */
    public void updateResults(List<hire> results) {
        try {
            hireItems.clear();
            hireItems = results;
            this.notifyDataSetChanged();
        }
        catch (Exception e)
        {
            Log.e("Exception",e.getMessage());
        }
    }

    static class ViewHolder{
        TextView No;
        TextView Pickup;
        TextView Destination;
        TextView Timestamp;
        TextView Status;
        Button cancel;

    }

    /**
     * Async task for cancelling a request
     */
    private class MyTaskParams {
        hire hires;
       View v;

        MyTaskParams(hire h, View v1) {
            this.hires = h;
            this.v = v1;
        }
    }

    /**
     * Async Task for cancelling a request
     */
   public  class CancelRequest extends AsyncTask<MyTaskParams, View,String> {
        boolean failure = false;
       View v;
       @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }
       /*
        TODO Auto-generated method stub
        Check for success tag
        */

        /**
         *
         * @param params
         * @return
         * @exception JSONException
         * @exception NullPointerException
         *
         */
       protected String doInBackground(MyTaskParams... params) {
           hire my=params[0].hires;
           v=params[0].v;
           int success;
            try {

                Log.d("Cancelling!", "starting");
                List<NameValuePair> params1 = new ArrayList<NameValuePair>();
                params1.add(new BasicNameValuePair("reqId",String.valueOf(my.getId())));
                JSONObject json = jsonParser.makeHttpRequest(ApplicationConstants.CANCEL_URL, "POST",params1);
                Log.d("Cancel attempt", json.toString()+String.valueOf(my.getId()));
                success = json.getInt(ApplicationConstants.TAG_SUCCESS);
                if (success == 1) {
                    Log.d("Cancelled!", json.toString());


                    return json.getString(ApplicationConstants.TAG_MESSAGE);
                }else{
                    Log.d("Cannot cancel!", json.getString(ApplicationConstants.TAG_MESSAGE));
                    return json.getString(ApplicationConstants.TAG_MESSAGE);
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
            catch (NullPointerException e)
            {
                e.printStackTrace();
            }
           return null;
        }

        @Override
        protected void onPostExecute(String file_url){
            String str=new String("Cancelled");
            Toast.makeText(v.getContext(), str, Toast.LENGTH_SHORT).show();

        }
    }

    /**
     * Get all hire requests
     */
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
                List<NameValuePair> params = new ArrayList<NameValuePair>();
                params.add(new BasicNameValuePair("email", mEmail));
                JSONObject json =jsonParser.makeHttpRequest(ApplicationConstants.FETCH_HIRES_URL, "POST", params);
                Log.d("Fetch vehicle attempt", json.toString());
                success = json.getInt(ApplicationConstants.TAG_SUCCESS);

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
                                        catObj.getString("vehicle_type"),
                                        catObj.getInt("Request_ID")

                                );
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
                    return json.getString(ApplicationConstants.TAG_MESSAGE);
                }else{
                    Log.d("Error!", json.getString(ApplicationConstants.TAG_MESSAGE));
                    return json.getString(ApplicationConstants.TAG_MESSAGE);

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

            }
            populateList();

        }
        @Override
        protected void onProgressUpdate(String... values) {
            // super.onProgressUpdate(values);


        }
    }
    private void populateList() {
        lables = new ArrayList<hire>();
        for (int i = 0; i < hires.size(); i++) {
            lables.add(hires.get(i));
        }
        updateResults(lables);

    }
}