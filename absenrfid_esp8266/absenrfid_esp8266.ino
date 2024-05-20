#include <ESP8266WebServer.h>
#include <ArduinoHttpClient.h>
#include "LiquidCrystal_I2C_PLUS.h"
#include <WiFiClient.h>
#include <DNSServer.h>
#include <MFRC522.h>
#include <SPI.h>
#include <ArduinoJson.h>
#include "html_content.h"
#include "classifyEmoji.h"

#define RST_PIN D3
#define SS_PIN D4

ESP8266WebServer server(80);
DNSServer dnsServer;
WiFiClient wifi;
MFRC522 rfid(SS_PIN, RST_PIN);
LiquidCrystal_I2C_PLUS lcd(0x27,16,2);
DynamicJsonDocument doc(1024);

//Host
const char host[] = "example.com";
const int port = 8000;
const String tokenV = "/api/validToken";
const String mainUrl = "/api/rfid";
HttpClient client = HttpClient(wifi, host, port);

//
const String ruang = "Lab 1 TKJ";
const String ssid = ruang;
const String password = "123456789";
const int wifiTimeout = 15; //TimeOut For Wifi Connection (Seconds)
String targetSSID, targetPass, token;

void fit(String msg){
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.printFit(msg);
}

void emoji(String type){
  lcd.clear();
  lcd.setCursor(6, 0);
  lcd.printEmoji(type);
  delay(1000);
}

void info(String msg){
  fit(msg);
  Serial.println(msg);
  delay(2000);
}

void startAP(){
  info("Starting Access Point...");
  WiFi.mode(WIFI_AP);
  WiFi.softAP(ssid, password);
  info("IP Address:" + WiFi.softAPIP().toString());
}

bool setNetwork(){
  WiFi.mode(WIFI_STA);
  WiFi.begin(targetSSID, targetPass);

  for(int x = 0; WiFi.status() != WL_CONNECTED && x < wifiTimeout; x++){
    Serial.print(".");
    delay(1000);
  }

  if(WiFi.status() != WL_CONNECTED){
    Serial.println();
    info("Koneksi Gagal");
    return false;
  }

  Serial.println();
  
  info("Koneksi Berhasil");

  return true;
}

String listNetwork(String networks = ""){
  int totalN = WiFi.scanNetworks();
  for(int x = 0; x < totalN;x++){
    networks += "<h3><a href='javascript:void(0)' onclick='setSSID(this.innerHTML)'>" + WiFi.SSID(x) + "</a></h3>";
  }
  return networks;
}

void setConfig(){
  targetSSID = server.arg("ssid");
  targetPass = server.arg("password");
  token = server.arg("token");

  Serial.println("Config is Ready\nSSID : " + targetSSID + "\nPassword : " + targetPass + "\nToken : " + token);

  if(validation() == false){
    info("Validasi Gagal");
    info("Memulai Ulang");
    startAP();
  }
}

void mainWeb(){
  server.send(200, "text/html", mainPage(listNetwork()));
}

void setRoutes(){
  server.on("/", mainWeb);
  server.on("/setting", setConfig);
}

bool validation(){
  // WiFi Validation
  info("Menunggu Koneksi");

  if(setNetwork() == false){
    return false;
  }

  // Token Validation
  if(tokenValidation() == false){
    return false;
  }
  
  info("Validasi Berhasil");
  return true;
}

String getId(String id = ""){
  for(byte x = 0; x < rfid.uid.size; x++){
    id +=rfid.uid.uidByte[x];
  }
  return id;
}

bool tokenValidation(){
  client.beginRequest();
  client.post(tokenV);
  client.sendHeader("absenrfid-token", token);
  client.endRequest();

  int statusCode = client.responseStatusCode();
  String response = client.responseBody();

  if(statusCode != 200){
    info("Request Gagal");
    return false;
  }

  if(response == "false"){
    info("Invalid Token");
    return false;
  }

  info("Valid Token");
  return true;
}

bool sendRequest(){
  String idKartu = getId();
  String data = "id_kartu=" + idKartu + "&ruang=" + ruang;

  client.beginRequest();
  client.post(mainUrl);
  client.sendHeader("Content-Type", "application/x-www-form-urlencoded");
  client.sendHeader("Content-Length", data.length());
  client.sendHeader("absenrfid-token", token);
  client.beginBody();
  client.print(data);
  client.endRequest();

  int statusCode = client.responseStatusCode();
  String response = client.responseBody();

  if(statusCode != 200){
    info("Request Gagal");
    Serial.println(statusCode);
    return false;
  }

  deserializeJson(doc, response);

  for(int x = 0; x < doc.size(); x++){
    info(doc[x]);
    if(x == 0){
      classifyEmoji(doc[0]);
    }
  }

  return true;
}

void setup() {
  Serial.begin(115200);
  info("Starting...");
  
  // Setup RFID Sensor
  SPI.begin();
  rfid.PCD_Init();

  // Setup Access Point
  startAP();

  // Setup Server
  setRoutes();
  server.begin();
}

void loop() {
  server.handleClient();

  if(!rfid.PICC_IsNewCardPresent()){
    info("Tempelkan Kartu RFID");
    return;
  }

  if(!rfid.PICC_ReadCardSerial()){
    info("Tempelkan Kartu RFID");
    return;
  }

  info("Validasi...");
  sendRequest();
}
