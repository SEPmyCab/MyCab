package com.example.pathum.mycabpickme;

/**
 * Created by Nu on 10/12/15.
 */
public class hire {
    String timestamp;
    String pickup;
    String destination;
    String status;
    String type;


    public hire(){}
    public hire(String timestampP,String pickupP,String destinationP,String statusP,String typeP)
    {
        this.timestamp=timestampP;
        this.pickup=pickupP;
        this.destination=destinationP;
        this.status=statusP;
        this.type=typeP;
    }

    public String getPickup() {
        return pickup;
    }

    public void setPickup(String pickup) {
        this.pickup = pickup;
    }

    public String getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(String timestamp) {
        this.timestamp = timestamp;
    }

    public String getDestination() {
        return destination;
    }

    public void setDestination(String destination) {
        this.destination = destination;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status =status ;
    }



}
