package com.example.pathum.mycabpickme;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by Nu on 7/24/2015.
 */
public class Utility {
    private static Pattern pattern;
    private static Matcher matcher;
    //Email Pattern

    /**
     * Validate Email with regular expression
     *
     * @param email
     * @return true for Valid Email and false for Invalid Email
     */
    public static boolean validate(String email) {
        pattern = Pattern.compile(ApplicationConstants.EMAIL_PATTERN);
        matcher = pattern.matcher(email);
        return matcher.matches();

    }
    /**
     * Checks for Null String object
     *
     * @param txt
     * @return true for not null and false for null String object
     */
    public static boolean isNotNull(String txt){
        return txt!=null && txt.trim().length()>0 ? true: false;
    }
}
