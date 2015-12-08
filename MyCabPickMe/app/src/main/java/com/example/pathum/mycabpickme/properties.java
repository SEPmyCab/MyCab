package com.example.pathum.mycabpickme;

import android.widget.EditText;
import android.widget.RadioButton;

/**
 * Created by lakshan on 10/8/2015.
 * Handle all the static veriables from here
 */
public  class properties {

    public properties(){

    }
    /*
     *Forgot Password
     */

    //forgot password access url
    public static final String LOGIN_URL_FORGOTPASSWORD="http://cabeelk.com/myCab2/ForgotPassword.php";
    //forgot password sms body
    public static final String FORGOT_PASSWORD_SMS="Your PickMe App Login password is : ";

    /*
     * Update User profile
     */
    //Retrive profile details URL
    public static final String RETRIVER_PROFILE = "http://cabeelk.com/myCab2/UserProfileRetriveData.php";
    //Update profile URL
    public static final String UPDATE_PROFILE_URL="http://cabeelk.com/myCab2/updatePassengerProfile.php";

    public static final String TAG_SUCCESS = "success";
    public static final String TAG_MESSAGE = "message";


    /*
     *Validations
     */

    public static final String PHONE_NUMBER_FORMAT="^[+]?[0-9]{10,12}";
    public static final String NAME="^[a-z,A-Z]*";
    public static final String EMAIL_FORMAT="^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";

    /*
     *Rate Drivers
     */
    public static final String RATE_DRIVER="http://cabeelk.com/myCab2/Rating.php";
    /*
     *Report Drivers
     */

    public static final String REPORT_DRIVER="http://cabeelk.com/myCab2/reporting.php";
    public static final String DRUNK_AND_DRIVE="Drunk and Drive";
    public static final String PLAY_LOUD_MUSIC="Playing loud music from car stereos";
    public static final String CHAIN_HORNING="Speed boat hooning";
    public static final String OFFENCES="Burnout offences";
    public static final String DRIVE_SPEED="Illegal street racing";
    public static final String TRAVEL_HIGH_SPEED= "Travelling at high speeds";
    public static final String OTHER="Other";

}
