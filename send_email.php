<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = htmlspecialchars($_POST['message']);

    // ตั้งค่าการส่งอีเมล
    $to = "your-email@example.com"; // เปลี่ยนเป็นอีเมลที่คุณต้องการรับ
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // เนื้อหาอีเมล
    $email_message = "
    <html>
    <head>
        <title>$subject</title>
    </head>
    <body>
        <h2>รายละเอียดจากผู้ใช้:</h2>
        <p><strong>อีเมลผู้ส่ง:</strong> $email</p>
        <p><strong>หัวข้อ:</strong> $subject</p>
        <p><strong>ข้อความ:</strong><br>$message</p>
    </body>
    </html>
    ";

    // ส่งอีเมล
    if (mail($to, $subject, $email_message, $headers)) {
        echo "ส่งอีเมลสำเร็จ!";
    } else {
        echo "เกิดข้อผิดพลาดในการส่งอีเมล";
    }
} else {
    echo "ไม่รองรับการเข้าถึงโดยตรง";
}
?>
