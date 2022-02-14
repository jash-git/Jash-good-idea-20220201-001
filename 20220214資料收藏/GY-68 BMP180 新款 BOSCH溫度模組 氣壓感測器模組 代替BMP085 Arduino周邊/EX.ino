#include <SFE_BMP180.h>
#include <Wire.h>

SFE_BMP180 pressure;  // 建立一個物件名為 pressure
#define ALTITUDE 25   // 台灣西部海岸大約的海平面高度

void setup()
{
  Serial.begin(9600);
  Serial.println("REBOOT");
  
  // 初始設定
  if (pressure.begin())
    Serial.println("BMP180 init success");
  else
  {
    // 初始化錯誤，一般是連接問題
    Serial.println("BMP180 init fail\n\n");
    while(1);    // 永久停在這裡
  }
}

void loop()
{
  char status;
  double T,P,p0,a;

  // 每 10秒鐘偵測一次

  // If you want sea-level-compensated pressure, as used in weather reports,
  // you will need to know the altitude at which your measurements are taken.
  // We're using a constant called ALTITUDE in this sketch:
  
  Serial.println();
  Serial.print("provided altitude: ");
  Serial.print(ALTITUDE,0);
  Serial.print(" meters, ");
  Serial.print(ALTITUDE*3.28084,0);
  Serial.println(" feet");
  
  // 如果要測量高度，而不是壓力，就需要提供已知的基本壓力
  
  // 取得溫度量測值
  
  // Start a temperature measurement:
  // If request is successful, the number of ms to wait is returned.
  // If request is unsuccessful, 0 is returned.

  status = pressure.startTemperature();
  if (status != 0)
  {
    // 等待感測完成
    delay(status);

    // 取得完整溫度測量，感測值存在變數T，函數回傳 1表示成功，0表示失敗

    status = pressure.getTemperature(T);
    if (status != 0)
    {
      // 顯示感測值
      Serial.print("temperature: ");
      Serial.print(T,2);
      Serial.print(" .C,        ");
      Serial.print((9.0/5.0)*T+32.0,2);
      Serial.println(" .F");
      
      // 量測壓力
      // 參數設定從 0 到 3 (最高的解析度，等待較久)
      // 感測成功會傳回等待多少 ms，如果不成功會傳回 0

      status = pressure.startPressure(3);
      if (status != 0)
      {
        // 等待感測完成
        delay(status);

        // 取得完整的壓力感測值，感測值存在變數 P，這個函數需要先前取得的溫度 T       
        // 假使溫度變化不大，可以只取得一次的值即可，函數執行成功會傳回 1，失敗傳回 0

        status = pressure.getPressure(P,T);
        if (status != 0)
        {
          // 列出感測值
          Serial.print("absolute pressure: ");
          Serial.print(P,2);
          Serial.print(" mb,     ");
          Serial.print(P*0.0295333727,2);
          Serial.println(" inHg");

          // 壓力感測值傳回絕對壓力，會隨著高度而變化，要移除高度的影響，需使用 sealevel 函數在目前的高度，
          // 這個數字常被用在氣象報告中，參數 P = 絕對壓力(毫巴), 高度 = 目前高度(公尺/米）.
          // 傳回值 p0 = sealevel函數的補償壓力(毫巴)

          p0 = pressure.sealevel(P,ALTITUDE); // we're at 1655 meters (Boulder, CO)
          Serial.print("relative (sea-level) pressure: ");
          Serial.print(p0,2);
          Serial.print(" mb,     ");
          Serial.print(p0*0.0295333727,2);
          Serial.println(" inHg");

          // 如果要從壓力感測值得知高度，需使用高度函數 altitude，以及先言算出的基準壓力.
          // 參數 P = 絕對壓力(毫巴）, p0 = 基準壓力(毫巴）. 傳回值 a = 高度(公尺/米)

          a = pressure.altitude(P,p0);
          Serial.print("computed altitude: ");
          Serial.print(a,0);
          Serial.print(" meters, ");
          Serial.print(a*3.28084,0);
          Serial.println(" feet");
        }
        else Serial.println("error retrieving pressure measurement\n");
      }
      else Serial.println("error starting pressure measurement\n");
    }
    else Serial.println("error retrieving temperature measurement\n");
  }
  else Serial.println("error starting temperature measurement\n");

  delay(5000);  // 暫停5秒 
}