<?php

class TurfBookingWebsite {
    private $title;
    private $header;
    private $content;

    public function __construct($title, $header, $content) {
        $this->title = $title;
        $this->header = $header;
        $this->content = $content;
    }

    public function displayPage() {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>{$this->title}</title>";
        echo "<style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 80%;
                    margin: 0 auto;
                    padding: 20px;
                }
                .header {
                    background-color: #4CAF50;
                    color: white;
                    text-align: center;
                    padding: 10px 0;
                }
                .content {
                    background-color: white;
                    padding: 20px;
                    margin-top: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .content h1 {
                    color: #333;
                }
                .content p {
                    color: #666;
                    line-height: 1.6;
                }
              </style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<div class='header'>";
        echo "<h1>{$this->header}</h1>";
        echo "</div>";
        echo "<div class='content'>";
        echo $this->content;
        echo "</div>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
}

$title = "Turf Booking Website";
$header = "Welcome to Our Turf Booking Website";
$content = "<h1>About Us</h1>
            <p>Our turf booking website offers a convenient and efficient way for you to book sports ground turfs for your games and events. With our easy-to-use interface, you can browse available time slots, check the status of your bookings, and confirm your reservations in just a few clicks.</p>
            <p>We provide a variety of turfs suitable for different sports such as football, cricket, and more. Our goal is to ensure that you have the best experience possible, whether you're booking for a casual game with friends or an organized event.</p>
            <p>Our website features a user-friendly design, making it simple to navigate and find the information you need. We also offer customer support to assist you with any questions or issues you may have.</p>
            <p>Thank you for choosing our turf booking website. We look forward to helping you enjoy your sporting events with ease and convenience.</p>";

$turfBookingWebsite = new TurfBookingWebsite($title, $header, $content);
$turfBookingWebsite->displayPage();
?>
