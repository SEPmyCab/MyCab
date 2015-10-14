package com.example.pathum.mycabpickme;
/**
 * Created by Nu on 9/11/2015.
 */
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.provider.Settings;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;


public class ErrorActivity extends ActionBarActivity implements View.OnClickListener {
    String errDetail;
    TextView TV_Details;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_error);
        getSupportActionBar().hide();
        TextView TVerror=(TextView)findViewById(R.id.tv_err);
        Intent intent = getIntent();
        TVerror.setText(intent.getExtras().getString("errmsg"));
        errDetail=intent.getExtras().getString("error");

        TV_Details=(TextView)findViewById(R.id.tv_errDetails);


    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_error, menu);
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
        switch (v.getId()){
            case R.id.btn_view:
            TV_Details.setText(errDetail);
                break;
            case R.id.btn_network:
                Intent i = new Intent(Settings.ACTION_WIRELESS_SETTINGS);
                startActivity(i);
                break;
            case R.id.btn_back:
                Intent j = new Intent(this,RequestActivity.class);
                startActivity(j);
                break;
        }
    }
}
