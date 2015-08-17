package com.example.pathum.mycabidrive;

/**
 * Created by Nu on 5/8/15.
 */
public class Vehicle {
    private String reg_no;
    private String type;
    private String manu;
    private String model;
    private  int passengers;
    private String ac;
    private String driver;

    public Vehicle(String reg_no, String type, String manu, String model, int passengers, String ac, String driver) {
        this.reg_no = reg_no;
        this.type = type;
        this.manu = manu;
        this.model = model;
        this.passengers = passengers;
        this.ac = ac;
        this.driver = driver;
    }

    public Vehicle(String reg_no) {
        this.reg_no = reg_no;
    }

    public String getReg_no() {
        return reg_no;
    }

    public void setReg_no(String reg_no) {
        this.reg_no = reg_no;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getManu() {
        return manu;
    }

    public void setManu(String manu) {
        this.manu = manu;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public String getAc() {
        return ac;
    }

    public void setAc(String ac) {
        this.ac = ac;
    }

    public int getPassengers() {
        return passengers;
    }

    public void setPassengers(int passengers) {
        this.passengers = passengers;
    }

    public String getDriver() {
        return driver;
    }

    public void setDriver(String driver) {
        this.driver = driver;
    }


    public Vehicle() {
    }

}
