package com.example.pathum.mycabpickme;
/**
 * Created by Nu on 7/11/2015.
 */
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

/**
 * Created by DELL on 6/12/2015.
 */
public class MarkerJSONParser {
    public List<HashMap<String,String>> parse(JSONObject jObject){

        JSONArray jMarkers = null;
        try {
            /** Retrieves all the elements in the 'markers' array */
            jMarkers = jObject.getJSONArray("markers");
        } catch (JSONException e) {
            e.printStackTrace();
        }
        /** Invoking getMarkers with the array of json object
         * where each json object represent a marker
         */
        return getMarkers(jMarkers);
    }


    private List<HashMap<String, String>> getMarkers(JSONArray jMarkers){
        int markersCount = jMarkers.length();
        List<HashMap<String, String>> markersList = new ArrayList<HashMap<String,String>>();
        HashMap<String, String> marker = null;

        /** Taking each marker, parses and adds to list object */
        for(int i=0; i<markersCount;i++){
            try {
                /** Call getMarker with marker JSON object to parse the marker */
                marker = getMarker((JSONObject)jMarkers.get(i));
                markersList.add(marker);
            }catch (JSONException e){
                e.printStackTrace();
            }
        }

        return markersList;
    }

    /** Parsing the Marker JSON object */
    private HashMap<String, String> getMarker(JSONObject jMarker){

        HashMap<String, String> marker = new HashMap<String, String>();
        String lat = "-NA-";
        String lng ="-NA-";
        String fn ="-NA-";
        String ln ="-NA-";
        String ve="-NA-";
        String ph ="-NA-";
        String cr ="-NA-";
        String photo="-NA-";


        try {
            // Extracting latitude, if available
            if(!jMarker.isNull("Latitude")){
                lat = jMarker.getString("Latitude");
                Log.d("latitude", lat);
            }

            // Extracting longitude, if available
            if(!jMarker.isNull("Longitude")){
                lng = jMarker.getString("Longitude");
                Log.d("longitude", lng);
            }
            if(!jMarker.isNull("FName")){
                fn = jMarker.getString("FName");
                Log.d("fname", fn);
            }
            if(!jMarker.isNull("LName")){
                ln = jMarker.getString("LName");
                Log.d("lname", ln);
            }
            if(!jMarker.isNull("Phone_No")){
                ph = jMarker.getString("Phone_No");
                Log.d("phone", ph);
            }
            if(!jMarker.isNull("Certification")){
                cr = jMarker.getString("Certification");
                Log.d("cer", cr);
            }
            if(!jMarker.isNull("Vehicle_ID")){
                ve = jMarker.getString("Vehicle_ID");
                Log.d("vehicle", ve);
            }
            if(!jMarker.isNull("Photo")){
                photo = jMarker.getString("Photo");
                Log.d("photo", photo);
            }


            marker.put("Latitude", lat);
            marker.put("Longitude", lng);
            marker.put("FName",fn);
            marker.put("LName",ln);
            marker.put("Phone", ph);
            marker.put("Certification",cr);
            marker.put("Vehicle_ID",ve);
            marker.put("Photo",photo);

        } catch (JSONException e) {
            e.printStackTrace();
        }
        return marker;
    }
}
