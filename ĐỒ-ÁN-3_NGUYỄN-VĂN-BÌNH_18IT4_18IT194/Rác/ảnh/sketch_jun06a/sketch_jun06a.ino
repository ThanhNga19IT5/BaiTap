void setup() 
  {
    pinMode(2, OUTPUT);
    pinMode(4, OUTPUT);
    pinMode(6, OUTPUT);
  
  }

void loop() 
  {
  
  digitalWrite(2, HIGH); // den do
  delay(5000);
  digitalWrite(2, LOW);
  
  digitalWrite(4, HIGH); // den vang 
  delay(3000);
  digitalWrite(4, LOW);
  
  digitalWrite(6, HIGH); // den xanh
  delay(5000);
  digitalWrite(6, LOW);
  }
