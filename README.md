# restapi-doctor

Założenia zadania:
Jako użytkownik (lekarz) chcę mieć możliwość:
-Dodawać dokumenty dla pacjenta którego leczenie prowadzę
-Przechowanie dokumentu powinno być operacją asynchroniczną.
-Dodawany dokument musi być plikiem pdf nie większym niż określona liczba MB. Domyślnie powinno być to 5MB z możliwością konfiguracji w zmiennej środowiskowej
-Użytkownik (lekarz) może zarządzać dokumentami tylko swoich pacjentów

Uwagi:
Nie ma potrzeby implementacji logowania i rejestracji z wykorzystaniem bearer tokenów. Na potrzeby zadania wykorzystaj basic auth - email i hasło użytkownika
Wymagana jest tylko implementacja zarządzania dokumentami pacjentów. Przykładowe rekordy pacjentów i lekarzy należy udostępnić w przesłanym rozwiązaniu.
