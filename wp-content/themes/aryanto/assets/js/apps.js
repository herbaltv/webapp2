function computeBMI() {
    // user inputs
    var height = Number(document.getElementById("height").value);
    var heightunits = document.getElementById("heightunits").value;
    var weight = Number(document.getElementById("weight").value);
    var weightunits = document.getElementById("weightunits").value;


    //Convert all units to metric
    if (heightunits == "inches") height /= 39.3700787;
    if (weightunits == "lb") weight /= 2.20462;

    //Perform calculation

    //        var BMI = weight /Math.pow(height, 2)*10000;
    var BMI = Math.round(weight / Math.pow(height, 2) * 10000);

    //Display result of calculation
    document.getElementById("output").innerText = Math.round(BMI * 100) / 100;

    var output = Math.round(BMI * 100) / 100;
    var file = "normal";
    if (output < 18.5){
        document.getElementById("comment").innerText = "Kurang";
        file = "underweight";
    } else if (output >= 18.5 && output <= 25){
        document.getElementById("comment").innerText = "Sehat";
        file = "normal";
    } else if (output >= 25 && output <= 30){
        document.getElementById("comment").innerText = "Obes";
        file = "obese";
    } else if (output > 30) {
        document.getElementById("comment").innerText = "Obes Level 2";
        file = "obesel2";
    }
        
    jQuery(function(){
        var url = WPURLS.siteurl;
        jQuery("#description").load(url+"/"+file); 
    });
        
}