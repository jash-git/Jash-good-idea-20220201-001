package com.example.as_test01;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void butt01_onClick(View view) {
        EditText edit01=findViewById(R.id.edit01);
        edit01.setText("HELLO Android");
    }
}