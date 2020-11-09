int sensor1 = A0; // Cảm biến chiều 1
int sensor2 = A1; // Cảm biến chiều 2
int loa1 = A4; // Loa chiều 1
int loa2 = A5; // Loa chiều 2

int ledGreen[] = {0x82, 0x92, 0x99, 0xB0,0xA4, 0xF9};//{2, 18, 25, 48, 36, 121}; // các số từ 6 - 1 cho đèn xanh
int ledRed[] = {0x90, 0x80, 0xF8, 0x82, 0x92, 0x99, 0xB0,0xA4, 0xF9}; //{16, 0, 120, 2, 18, 25 }; // các số từ 9 - 1 cho đèn đỏ
int ledYellow[] = {0xB0,0xA4, 0xF9};//{48, 36, 121 }; // các số từ 3 - 1 cho đèn vàng

int x;  // Biến dùng trong vòng lặp

// Để tiết kiệm chân và mở rộng điều khiển của Arduino nên sẽ dùng 2 IC ghi dịch 74HC595
// IC 74HC595 dùng để điều khiển hiển thị thời gian của led 7 đoạn
// IC 74HC595 thứ 1 
int latchPin1 = 8; // chân ST_CP(chân số 12)
int clockPin1 =  9 ; // chân SH_CP(chân số 11)
int dataPin1 = 10; // chân DS (chân số 14)
// IC 74HC595 thứ 2
int latchPin2 = 11 ; // chân ST_CP(chân số 12)
int clockPin2 = 12; // chân SH_CP(chân số 11)
int dataPin2 =13 ; // chân DS (chân số 14)

// Ngã tư có hai chiều nên sẽ khai báo chân cho 2 chiều đèn như sau:
//Chiều thứ 1
int red1 = 4; // Đèn đỏ thứ 1
int yellow1 = 3; // Đèn vàng thứ 1
int green1 = 2; // Đèn xanh thứ 1
//Chiều thứ 2
int red2 = 7; // Đèn đỏ thứ 2 
int yellow2 = 6; // Đèn vàng thứ 2
int green2 = 5; // Đèn xanh thứ 2
void denmau_c1(){
  // Chiều thứ 1
  pinMode(red1, OUTPUT);
  pinMode(yellow1, OUTPUT);
  pinMode(green1, OUTPUT);
}
void dendem_c2(){

  // IC 74HC595 thứ 1
  pinMode(latchPin1, OUTPUT);
  pinMode(clockPin1, OUTPUT);
  pinMode(dataPin1, OUTPUT);
}
void cambienloa_c2(){

  // Cảm biến và loa chiều thứ 1
  pinMode(sensor1, INPUT_PULLUP); // Cảm biến chiều 1
  pinMode(loa1, OUTPUT); // Loa chiều 1
}
void denmau_c2(){
  //Chiều thứ 2
  pinMode(red2, OUTPUT);
  pinMode(yellow2, OUTPUT);
  pinMode(green2, OUTPUT);
  
}
void dendem_c2(){
  // IC 74HC595 thứ 2
  pinMode(latchPin2, OUTPUT);
  pinMode(clockPin2, OUTPUT);
  pinMode(dataPin2, OUTPUT);
}
void cambienloa_c2(){
  // Cảm biến và loa chiều thứ 2
  pinMode(sensor2, INPUT_PULLUP); // Cảm biến chiều 2
  pinMode(loa2, OUTPUT); // Loa chiều 2
}
void setup() {
  Serial.begin(9600); // Mở cổng Serial ở mức 9600
  void denmau_c1();
  void dendem_c1();
  void cambienloa_c1();

 
  void denmau_c2();
  void dendem_c2();
  void cambienloa_c2();
}

void loop() {
  // put your main code here, to run repeatedly:
  // Code chưa được tái cấu trúc
  
  for (int i = 0; i < 18; i++) // Chu trình hiển thị được chia thành 4 giai đoạn
  {
      if (i < 6) // Giai đoạn 1 : Đèn xanh chiều thứ 1 bật , Đèn đỏ chiều thứ 2 bật
      { 
          for (x = 0; x < 100; x++) // vòng for này tương ứng với 1 giây hiển thị
          {
              // Chiều thứ 1
              digitalWrite(green1, HIGH); // Đèn xanh 1 bật
              digitalWrite(red1, LOW); // Đèn đỏ 1 tắt
              digitalWrite(yellow1, LOW); // Đèn vàng 1 tắt
              // IC 74HC595 thứ 1 : hiển thị thời gian đèn xanh của chiều thứ 1
              digitalWrite(latchPin1, LOW);  
              shiftOut(dataPin1, clockPin1, MSBFIRST, ledGreen[i]); // đẩy code vào IC
              digitalWrite(latchPin1, HIGH);
              // Chiều thứ 2
              digitalWrite(green2, LOW); // Đèn xanh tắt
              digitalWrite(red2, HIGH); // Đèn đỏ bật
              digitalWrite(yellow2, LOW); // Đèn vàng tắt
              // IC 74HC595 thứ 2  : hiển thị thời gian đèn đỏ của chiều thứ 2
              digitalWrite(latchPin2, LOW);  
              shiftOut(dataPin2, clockPin2, MSBFIRST, ledRed[i]);  // đẩy code vào IC
              digitalWrite(latchPin2, HIGH);
              // Điều khiển loa chiều thứ 2
              if (digitalRead(sensor2) == LOW) // Nếu có vật cản khi đèn đỏ chiều thứ 2 sáng thì loa 2 sẽ phát âm báo
              {
                  digitalWrite(loa2, HIGH); // Cấp nguồn cho loa 2
                  delay(10);
                  digitalWrite(loa2, LOW); // Tắt loa
              }
              else // Nếu đèn đỏ chiều thứ 2 tắt thì tắt loa
              {
                  digitalWrite(loa2, LOW);
                  delay(10);
              }
              
          }
      }
      else if (i >= 6 && i < 9) // Giai đoạn 2: Đèn vàng thứ 1 bật , Đèn đỏ thứ 2 bật
      {
          for (x = 0; x < 100; x++) // Vòng for tương ứng với 1 giây hiển thị
          {
              // Chiều thứ 1
              digitalWrite(green1, LOW); // Đèn xanh thứ 1 tắt
              digitalWrite(red1, LOW);  // Đèn đỏ thứ 1 tắt
              digitalWrite(yellow1, HIGH); // Đèn vàng thứ 1 bật
              // IC 74HC595 thứ 1 : hiển thị thời gian đèn vàng cuat chiều thứ 1
              digitalWrite(latchPin1, LOW);  
              shiftOut(dataPin1, clockPin1, MSBFIRST, ledYellow[i-6]); // đẩy code vào IC
              digitalWrite(latchPin1, HIGH);
              // Chiều thứ 2
              digitalWrite(green2, LOW); // Đèn xanh thứ 2 tắt
              digitalWrite(red2, HIGH);  // Đèn đỏ thứ 2 bật
              digitalWrite(yellow2, LOW); // Đèn vàng thứ 2 tắt
              // IC 74HC595 thứ 2: hiển thị thời gian đèn đỏ của chiều thứ 2
              digitalWrite(latchPin2, LOW); 
              shiftOut(dataPin2, clockPin2, MSBFIRST, ledYellow[i-6]);
              digitalWrite(latchPin2, HIGH);
              // Điều khiển loa chiều thứ 2 
              if (digitalRead(sensor2) == LOW)  // Nếu có vật cản khi đèn đỏ chiều thứ 2 bật thì loa 2 sẽ phát âm báo
              {
                  digitalWrite(loa2, HIGH);
                  delay(10);
                  digitalWrite(loa2, LOW);
              }
              else // Nếu đèn đỏ chiều thứ 2 tắt thì tắt loa
              {
                  digitalWrite(loa2, LOW);
                  delay(10);
              }
          }
      }
      else if (i >= 9 && i < 15) // Giai đoạn 3 : Đèn đỏ chiều thứ 1 bật, đèn xanh chiều thứ 2 bật // xanh
      {
           for (x = 0; x < 100; x++) // vòng for tương ứng với 1 giây hiển thị
           { 
              // Chiều thứ 1
              digitalWrite(green1, LOW); // Đèn vàng thứ 1 tắt
              digitalWrite(red1, HIGH); // Đèn đỏ thứ 1 bật
              digitalWrite(yellow1, LOW); // Đèn vàng thứ 1 tắt
              // IC 74HC595 thứ 1 : hiển thị thời gian đèn đỏ của chiều thứ 1
              digitalWrite(latchPin1, LOW);  
              shiftOut(dataPin1, clockPin1, MSBFIRST, ledRed[i-9]); 
              digitalWrite(latchPin1, HIGH);
              // Chiều thứ 2
              digitalWrite(green2, HIGH); // Đèn xanh thứ 2 bật
              digitalWrite(red2, LOW); // Đèn đỏ thứ 2 tắt
              digitalWrite(yellow2, LOW); // Đèn vàng thứ 2 tắt
              // IC 74HC595 thứ 2: hiển thị thời gian đèn xanh của chiều thứ 2
              digitalWrite(latchPin2, LOW);   
              shiftOut(dataPin2, clockPin2, MSBFIRST, ledGreen[i-9]);
              digitalWrite(latchPin2, HIGH);
              // Điều khiển loa chiều thứ 1
              if (digitalRead(sensor1) == LOW) // Nếu có vật cản khi đèn đỏ chiều thứ 1 bật thì loa 1 sẽ phát âm báo
              {
                  digitalWrite(loa1, HIGH);
                  delay(10);              
                  digitalWrite(loa1, LOW);
              }
              else // Nếu đèn đỏ chiều thứ 1 tắt thì tắt loa
              {
                  digitalWrite(loa1, LOW);
                  delay(10);
              }
           }
      }
      else if (i >= 15 && i < 18) // Giai đoạn 4: Đèn đỏ chiều thứ 1 bật, Đèn vang chiều thứ 2 bật
      {
          for (x = 0; x < 100; x++) // Vòng for tương ứng với 1 giây hiển thị
          { 
              // Chiều thứ 1
              digitalWrite(green1, LOW); // Đèn xanh 1 tắt
              digitalWrite(red1, HIGH); // Đèn đỏ 1 bật
              digitalWrite(yellow1, LOW); // Đèn vàng 1 tắt
              // IC 74HC595 thứ 1: hiển thị thời gian đèn đỏ của chiều thứ 1
              digitalWrite(latchPin1, LOW);  
              shiftOut(dataPin1, clockPin1, MSBFIRST, ledYellow[i-15]);  
              digitalWrite(latchPin1, HIGH); 
              // Chiều thứ 2
              digitalWrite(green2, LOW); // Đèn xanh 2 tắt
              digitalWrite(red2, LOW); // Đèn đỏ 2 tắt
              digitalWrite(yellow2, HIGH); // Đèn vàng 2 bật
              // IC 74HC595 thứ 2: hiển thị thời gian đèn vang của chiều thứ 2
              digitalWrite(latchPin2, LOW); 
              shiftOut(dataPin2, clockPin2, MSBFIRST, ledYellow[i-15]);
              digitalWrite(latchPin2, HIGH);
              // Điều khiển loa chiều thứ 1            
              if(digitalRead(sensor1) == LOW) // Nếu có vật cản khi đèn đỏ chiều thứ 1 bật thì loa 1 sẽ phát âm báo
              {
                  digitalWrite(loa1, HIGH);  
                  delay(10);
                  digitalWrite(loa1, LOW);
              }
              else // Nếu đèn đỏ chiều thứ 1 tắt thì tắt loa
              {
                  digitalWrite(loa2, LOW);
                  delay(10);
              }
         }
      }
  }     
}  
