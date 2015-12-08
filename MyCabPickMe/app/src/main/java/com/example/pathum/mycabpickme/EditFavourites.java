package com.example.pathum.mycabpickme;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


public class EditFavourites extends Activity {
    DBHelper db = new DBHelper(this);
    Favourites a = null;
    long ri = 0;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_favourites);
        String id = getIntent().getExtras().getString("id");
        int iid = Integer.parseInt(id);
        ri = (long) iid;

        Button updateBtn = (Button) findViewById(R.id.btnUpdateFavourites);
        updateBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                EditText nameTxt = (EditText) findViewById(R.id.editTextName);
                EditText pickupTxt = (EditText) findViewById(R.id.editTextPickup);
                EditText desTxt = (EditText) findViewById(R.id.editTextDestination);
                EditText typeTxt = (EditText) findViewById(R.id.editTextType);
                db.open();
                db.updateRecord(ri, nameTxt.getText().toString(), pickupTxt.getText().toString(), desTxt.getText().toString(), typeTxt.getText().toString());
                db.close();
                nameTxt.setText("");
                pickupTxt.setText("");
                desTxt.setText("");
                typeTxt.setText("");
                Toast.makeText(EditFavourites.this, "Favourite Updated", Toast.LENGTH_LONG).show();

                Intent intent = new Intent(EditFavourites.this, FavouriteList.class);
                startActivity(intent);
            }
        });

        db.open();
        a = db.getFavourite(iid);
        db.close();

        EditText nameTxt = (EditText) findViewById(R.id.editTextName);
        nameTxt.setText(a.name);
        EditText pickupTxt = (EditText) findViewById(R.id.editTextPickup);
        pickupTxt.setText(a.pickup);
        EditText desTxt = (EditText) findViewById(R.id.editTextDestination);
        desTxt.setText(a.destination);
        EditText typeTxt = (EditText) findViewById(R.id.editTextType);
        typeTxt.setText(a.type);

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_edit_favourites, menu);
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
}
