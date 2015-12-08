package com.example.pathum.mycabpickme;
/**
 * Created by Nu on 6/24/2015.
 */
public interface ApplicationConstants {
    // Php Application URL to store Reg ID created
    static final String APP_SERVER_URL = "http://cabeelk.com/myCab2/gcm.php?shareRegId=true";

    // Google Project Number
    static final String GOOGLE_PROJ_ID = "644389412859";
    // Message Key
    static final String MSG_KEY = "m";

    static final String TAG_SUCCESS = "success";
    static final String TAG_MESSAGE = "message";

    static final String EMAIL_PATTERN =
            "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@"
                    + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";


    /**
     * constants for LoginActivity.java
     */
    static final String LOGIN_URL = "http://cabeelk.com/myCab2/plogin.php";

    /**
     * constants for RequestActivity.java
     */
    static final String LOG_TAG = "Google Places Autocomplete";
    static final String PLACES_API_BASE = "https://maps.googleapis.com/maps/api/place";
    static final String TYPE_AUTOCOMPLETE = "/autocomplete";
    static final String OUT_JSON = "/json";
    static final String API_KEY = "AIzaSyApjqIQ6acIzJtno_hcTqlonK7CEYXgn14";
    static final int CONNECTION_FAILURE_RESOLUTION_REQUEST = 9000;
    static final String REQUEST_URL = "http://cabeelk.com/myCab2/passengerRequest.php?push=true";
    static final String NOTIFY_URL = "http://cabeelk.com/myCab2/selectDriver.php?push=true";
    static final String CANCEL_URL = "http://cabeelk.com/myCab2/cancel_pick_request.php?push=true";
    static final String FETCH_HIRES_URL = "http://cabeelk.com/myCab2/fetch_hires.php";

    /**
     * constants for GCMNotificationIntentService.java
     */
    static final int notifyID = 9001;

    /**
     * constants for RegisterActivity.java
     */
    static final String REGISTER_URL = "http://cabeelk.com/myCab2/pregister.php";


}
