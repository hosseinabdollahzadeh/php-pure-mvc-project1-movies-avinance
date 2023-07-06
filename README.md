## Installation

1. Download the archive or clone the project using git
2. Create database schema
3. Create `.env` file from `.env.example` file and adjust database parameters (including schema name)
4. Run `composer install`
5. Run migrations by executing `php migrations.php` from the project root directory
6. Go to the `public` folder 
7. Start php server by running command `php -S 127.0.0.1:8080`
8. download selenium-server-standalone-3.9.1.jar file from https://selenium-release.storage.googleapis.com/index.html?path=3.9/
9. download the chromedriver (the version that you use in your system) from https://sites.google.com/chromium.org/driver/downloads in directory `C:\Selenium\chromedriver.exe`
10. Navigate to the directory where you placed the Selenium Standalone Server JAR file and run `java -jar selenium-server-standalone-3.9.1.jar -role hub`
11. and open a new terminal where you placed the Selenium Standalone Server and run `java -Dwebdriver.chrome.driver=C:\Selenium\chromedriver.exe -jar selenium-server-standalone-3.9.1.jar -role node -hub http://localhost:4444/grid/register -browser "browserName=chrome,maxInstance=1,platform=WINDOWS" -port 55550`
12. Open in browser http://127.0.0.1:8080