package com.example.pathum.mycabpickme.validation;

import com.example.pathum.mycabpickme.properties;

/**
 * Created by lakshan on 10/9/2015.
 */
public class updateUserProfile_Validation extends validations_main {

    /**
     *
     * @param phone user last name
     * @exception NullPointerException
     * @exception Exception
     * @return
     */
    @Override
    public boolean phoneNumberValidator(String phone) {

        boolean status=false;
        try{
            if(phone.matches(properties.PHONE_NUMBER_FORMAT)){
                status= true;
            }else
                status= false;

        }catch (NullPointerException nullpointexception){

        }catch (Exception exception){

        }finally {

        }
        return status;
    }

    /**
     *
     * @param email user last name
     * @exception NullPointerException
     * @exception Exception
     * @return
     */
    @Override
    public boolean emailValidator(String email) {

        boolean status =false;
        try{
            if(email.matches(properties.EMAIL_FORMAT)){
                status= true;
            }else{
                status= false;
            }


        }catch (NullPointerException nullpointexception){

        }catch (Exception exception){

        }finally {

        }
        return status;
    }

    /**
     *
     * @param fname user first name
     * @param lname user last name
     * @exception NullPointerException
     * @exception Exception
     * @return
     */
    @Override
    public boolean nameValidator(String fname,String lname) {

        //name String parameter assign first name and last name
        String name=fname.concat(lname);
        Boolean status =false;

        try{
            if(name.matches(properties.NAME)){
                status= true;
            }else
                status= false;

        }catch (NullPointerException nullpointexception){

        }catch (Exception exception){

        }finally {

        }
        return status;
    }
}
