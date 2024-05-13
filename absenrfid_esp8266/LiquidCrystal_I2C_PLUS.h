#include <LiquidCrystal_I2C.h>
#include <map>

class LiquidCrystal_I2C_PLUS{
  public:
    LiquidCrystal_I2C lcd;

    LiquidCrystal_I2C_PLUS(uint8_t address, uint8_t columns, uint8_t rows, int column = 0, int row = 0, bool isEmoji = false, bool isFit = false, bool isClear = false)
    : lcd(address, columns, rows), cursor{column, row}, useEmoji(isEmoji), useFit(isFit), autoClear(isClear) {
      lcd.init();
      lcd.backlight();
    }

    void print(String msg){
      if(autoClear == true){
        lcd.clear();
      }

      if(useEmoji == true){
        printEmoji(msg);
        return;
      }
      else if(useFit == true){
        printFit(msg);
        return;
      }

      printMessage(msg);
    }

    void printFit(String msg){
      int prev = 0;
      int lastCol = 0;
      int lastRow = 0;

      for(int x = 0; x <= 16; x++){
        if(msg[x] == ' '){
          for(int y = prev; y < x; y++){
            lcd.setCursor(lastCol, lastRow);
            lcd.print(msg[y]);
            lastCol ++;
          }
          prev = x;
        }
      }

      if(msg.length() > 16){
        lastCol = 0;
        lastRow = 1;
        prev++;

        for(int x = prev; x < msg.length(); x++){
          if(msg[x] == ' '){
            for(int y = prev; y < x; y++){
              lcd.setCursor(lastCol, lastRow);
              lcd.print(msg[y]);
              lastCol ++;
            }
            prev = x;
          }
        }
      }

      finishFit(msg, prev, lastCol, lastRow);
    }

    void printAuto(String msg){
      lcd.clear();

      if(msg.length() > 16){  
        for(int x = 0; x <= 16; x++){
          lcd.setCursor(x, 0);
          lcd.print(msg[x]);
        }

        for(int x = 0; x < msg.length() - 16; x++){
          lcd.setCursor(x, 1);
          lcd.print(msg[x + 16]);
        }
        
        return;
      }

      lcd.setCursor(0, 0);
      lcd.print(msg);
    }

    void printMessage(String msg){
      defaultCursor();
      lcd.print(msg);
    }

    void printEmoji(String msg, int width = 3, int height = 2){
      auto it = listEmoji.find(msg);
      if (it != listEmoji.end()) {
        makeChar(it->second[0], it->second[1]);
        makeEmoji(width, height);
        delay(2000);
      }
    }

    void enableEmoji(){
      useEmoji = true;
    }

    void enableFit(){
      useFit = true;
    }

    void enableAutoClear(){
      autoClear = true;
    }

    void setCursor(int col = 0, int row = 0){
      cursor[0] = col;
      cursor[1] = row;
    }

    void clear(){
      lcd.clear();
    }

    private:
      uint8_t cursor[2];
      bool useFit;
      bool useEmoji;
      bool autoClear;

      std::map<String, int*> listEmoji = {
        {"happy", new int[2]{0, 5}},
        {"sad", new int[2]{6, 11}},
        {"angry", new int[2]{12, 17}},  
      };

      byte customChar[64][8]={
        {B00001,B00011,B00111,B01110,B11110,B11111,B11111,B11111},{B11111,B11111,B11111,B01110,B01110,B11111,B11111,B11111},{B10000,B11000,B11100,B01110,B01111,B11111,B11111,B11111},{B11011,B11000,B11100,B11110,B01111,B00111,B00011,B00001},{B11111,B00000,B00000,B00000,B00000,B11111,B11111,B11111},{B11011,B00011,B00111,B01111,B11110,B11100,B11000,B10000},
        {B00001,B00011,B00111,B01110,B11100,B11111,B11111,B11111},{B11111,B11111,B11111,B01110,B00100,B11111,B11111,B11111},{B10000,B11000,B11100,B01110,B00111,B11111,B11111,B11111},{B11111,B11111,B11110,B11100,B01101,B00111,B00011,B00001},{B11111,B00000,B00000,B11111,B11111,B11111,B11111,B11111},{B11111,B11111,B01111,B00111,B10110,B11100,B11000,B10000},
        {B00011,B00111,B00111,B01110,B11110,B11111,B11111,B11111},{B11111,B11111,B11111,B11111,B01110,B00100,B11111,B11111},{B10000,B11000,B11100,B01110,B01111,B11111,B11111,B11111},{B11111,B11111,B11111,B11110,B01111,B00111,B00011,B00000},{B11111,B11111,B00000,B11111,B11111,B11111,B11111,B00000},{B11111,B11111,B11111,B01111,B11110,B11100,B11000,B00000},
      };

      void defaultCursor(){
        lcd.setCursor(cursor[0], cursor[1]);
      }

      void makeChar(int start, int end){
        for(int x = 0; x <= end - start; x++){
          lcd.createChar(x, customChar[start + x]);
        }
      }

      void makeEmoji(int width = 3, int height = 2){
        for(int x = 0; x < height; x++){
          for(int y = 0; y < width; y++){
            lcd.setCursor(cursor[0] + y, cursor[1] + x);
            lcd.write(y + (width * x));
          }
        }
      }

      void finishFit(String msg, int prev, int lastCol, int lastRow){
        if(prev != msg.length()){
          for(int x = prev; x < msg.length(); x++){
            lcd.setCursor(lastCol, lastRow);
            lcd.print(msg[x]);
            lastCol ++;
          }
        }
      }
};