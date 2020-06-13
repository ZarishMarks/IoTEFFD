#include <SoftwareSerial.h>
#include <SPI.h>
#include <Ethernet.h>

SoftwareSerial gprsSerial(7,8); //tx rx
#include <String.h>
#include <DHT.h> 

#define DHTPIN A0

DHT dht(DHTPIN, DHT11);

 
int sensorIn = A0;

int sensorInA1 = A1;
float Carbon();
float sensor=A2;
float gas_value;
int sensorValue;
bool smokeSignal;

void setup()
{
  gprsSerial.begin(9600);               // the GPRS baud rate   
  Serial.begin(9600);    // the GPRS baud rate 
  dht.begin();
  delay(10000);
}
 
void loop()
{
      float h = dht.readHumidity();
      float t = dht.readTemperature(); 
     
      float concentration;
      float lat = 46.097400;    
      float lon = 18.214964;
    
      delay(10000);     
         
      Serial.print("Temperature = ");
      Serial.print(t);
      Serial.println("°C");
      Serial.print("Humidity = ");
      Serial.print(h);
      Serial.println("%");    
      
   /////////////////////// CO ////////////////////////////////

  //Read voltage

    Serial.begin(9600); // sets the serial port to 9600
    // Reading CO2 Concentration
    sensorValue = analogRead(0);// read analog input pin 0
    Serial.print("concentration=");
    Serial.print(sensorValue, DEC);// prints the value read
    Serial.println("PPM");
  {
    delay(10000);// wait 1000ms for next reading
  }
 
    /////////////////////// Smoke ////////////////////////////////


   Serial.begin(9600); // sets the serial port to 9600                 
  Serial.println("Gas sensor warming up!");                              
  {
    delay(10000); 
  }
  gas_value = 1;
  smokeSignal=analogRead(sensor);
  Serial.println(gas_value);
  {
    delay(10000);
  }

    if(smokeSignal>=1)
    gas_value = true;
    Serial.print("Smoke detected!");
    
    if(gas_value<1){
    smokeSignal =false;
    }
  
  { 
    delay(10000);
  }

  if (gprsSerial.available())
    Serial.write(gprsSerial.read());

  gprsSerial.println("AT");
  delay(1000);

  gprsSerial.println("AT+CPIN?");
  delay(1000);

  gprsSerial.println("AT+CREG?");
  delay(1000);

  gprsSerial.println("AT+CGATT?");
  delay(1000);

  gprsSerial.println("AT+CIPSHUT");
  delay(1000);

  gprsSerial.println("AT+CIPSTATUS");
  delay(2000);

  gprsSerial.println("AT+CIPMUX=0");
  delay(1000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CSTT=\"telenorgprs.com\"");//start task and setting the APN,
  delay(1000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIICR");//bring up wireless connection
  delay(1000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIFSR");//get local IP adress
  delay(1000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIPSPRT=0");
  delay(1000);
 
  ShowSerialData();
  
  gprsSerial.println("AT+CIPSTART=\"TCP\",\"api.thingspeak.com\",\"80\"");//start up the connection
  delay(10000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIPSEND");//begin send data to remote server
  delay(1000);
  ShowSerialData();
  
  String str="GET https://api.thingspeak.com/update?api_key=HRB8240C9G5WD7I0&field1=" + String(t) +"&field2="+String(h) +"&field3="+String(sensorValue) + "&field4="+String(gas_value);
  Serial.println(str);
  gprsSerial.println(str);//begin send data to remote server
  
  String local_link="GET localhost/Zarish_Final/monitoring.php?field1=" + String(t) +"&field2="+String(h) +"&field3="+String(sensorValue) + "&field4="+String(gas_value)+ "&field5="+String(smokeSignal)+ "&field6="+String(lat)+ "&field7="+String(longi);
  Serial.println(local_link); //database

  
  delay(10000);
  ShowSerialData();

  gprsSerial.println((char)26);//sending
  delay(1000);//waitting for reply, important! the time is base on the condition of internet 
  gprsSerial.println();
 
  ShowSerialData();

  gprsSerial.println("AT+CIPSHUT");//close the connection
  delay(100);
  ShowSerialData();
} 
  void ShowSerialData()
{
  while(gprsSerial.available()!=0)
  Serial.write(gprsSerial.read());
  delay(1000); 
  
}

