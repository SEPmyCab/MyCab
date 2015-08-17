package com.example.pathum.mycabidrive;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;


public class MainActivity extends ActionBarActivity implements View.OnClickListener {
private TextView welcome;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().hide();
        welcome=(TextView)findViewById(R.id.textWelcome);
        SharedPreferences mySharedPreferences ; mySharedPreferences=getSharedPreferences("MyPref",0);
        String mString= mySharedPreferences.getString("user_name","");
       // Bundle b=getIntent().getExtras();
        //String keepusername=b.getString("User Name");
        welcome.setText("Welcome "+mString);

    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
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

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.B_startHire:
                Intent m = new Intent(MainActivity.this, availabilityActivity.class);
                startActivity(m);
                break;
            case R.id.B_EditVehicle:
                Intent i = new Intent(MainActivity.this, VehicleActivity.class);
                startActivity(i);
                break;
            case R.id.B_EditPersonal:
                Intent j = new Intent(MainActivity.this, PersonalActivity.class);
                startActivity(j);
                break;
            case R.id.B_AddNew:
                Intent k = new Intent(MainActivity.this, AddVehicleActivity.class);
                startActivity(k);
                break;
            case R.id.B_Delete:
                Intent l = new Intent(MainActivity.this, DeleteVehicleActivity.class);
                startActivity(l);
                break;
        }
    }
}
