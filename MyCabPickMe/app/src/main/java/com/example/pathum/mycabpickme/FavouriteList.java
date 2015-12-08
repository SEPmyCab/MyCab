package com.example.pathum.mycabpickme;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.ContextMenu;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;


public class  FavouriteList extends Activity implements AdapterView.OnItemClickListener {
    DBHelper db=new DBHelper(this);
    int itemposition = 0;
    long iid=0;
    String itemValue=null;
    int sid=0;
    String pick="";
    String dest="";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_favourite_list);
        final ListView lv=(ListView)findViewById(R.id.listView);
        db.open();
        ArrayList<String> data = db.getData();
        db.close();
        lv.setAdapter(new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, data));

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Intent intent = new Intent(FavouriteList.this, FavouriteList.class);
                itemposition = position;
                intent.putExtra("book", itemposition);
                startActivityForResult(intent, 1);
            }
        });
        lv.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener() {
            @Override
            public boolean onItemLongClick(AdapterView<?> parent, View view, int position, long id) {
                itemposition = position;
                itemValue = (String) lv.getItemAtPosition(position);
                String a[] = itemValue.split(" - ");
                Log.e("array", a[0].toString());
                sid = Integer.parseInt(a[0]);
                pick=a[2];
                dest=a[3];
                return false;
            }
        });
        registerForContextMenu(lv);
    }

    @Override
    public void onItemClick(AdapterView<?> adapterView, View view, int position, long l) {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_favourite_list, menu);
        return true;
    }

    @Override
    public void onCreateContextMenu(ContextMenu menu, View v, ContextMenu.ContextMenuInfo menuInfo) {
        super.onCreateContextMenu(menu, v, menuInfo);
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.context_menu, menu);
    }

    /**
     * Create menu when longpressed a favourite
     * @param item
     * @return
     */
    @Override
    public boolean onContextItemSelected(MenuItem item) {

        AdapterView.AdapterContextMenuInfo info = (AdapterView.AdapterContextMenuInfo) item.getMenuInfo();
        int position = info.position;
        switch (item.getItemId()) {
            case R.id.edit:
                String b = Integer.toString(sid);

                Intent intent = new Intent(FavouriteList.this,EditFavourites.class);
                intent.putExtra("id", b);
                startActivity(intent);

                return true;

            case R.id.delete:
                iid = (long)sid;
                AlertDialog.Builder alertDialog = new AlertDialog.Builder(FavouriteList.this);
                alertDialog.setTitle("Confirm Delete");
                alertDialog.setMessage("Are you sure you want to delete?");
                alertDialog.setIcon(R.drawable.delimg);
                alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        db.open();
                        db.deleteRecord(iid);
                        db.close();
                        Toast.makeText(getApplicationContext(),

                                "Favourite Deleted", Toast.LENGTH_LONG)

                                .show();
                        Intent intent1 = new Intent(FavouriteList.this, FavouriteList.class);
                        startActivity(intent1);

                    }
                });
                alertDialog.setNegativeButton("NO", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                });
                alertDialog.show();
                return true;
            case R.id.cancel:
                return true;

            case R.id.request:
                String b1 = Integer.toString(sid);

                Intent intent1 = new Intent(FavouriteList.this,RequestActivity.class);
                intent1.putExtra("id", b1);
                intent1.putExtra("pick", pick);
                intent1.putExtra("dest", dest);
                startActivity(intent1);
                return true;

            default:
                return super.onContextItemSelected(item);

        }
    }



}

