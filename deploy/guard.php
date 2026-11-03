<?php
$path = basename($_SERVER['SCRIPT_NAME']);
if (str_starts_with($path, 'admin_') || in_array($path, ['insert.php'])) { http_response_code(403); exit('Administration is disabled in this public demo.'); }
if (in_array($path, ['login.php','register.php'])) { header('Location: /index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($path, ['checkout.php','contact.php'])) { header('Content-Type: text/html; charset=utf-8'); exit('เว็บสาธิต: ไม่รับคำสั่งซื้อหรือข้อมูลติดต่อจริง <a href="/index.php">กลับหน้าแรก</a>'); }
session_start();
$_SESSION['user_id']=1;
$_SESSION['user_name']='Demo Visitor';
$_SESSION['user_email']='visitor@example.invalid';
ob_start(function($html) { return preg_replace('/(<body[^>]*>)/i', '$1<div style="position:relative;z-index:9999;padding:14px;background:#fff3cd;color:#513e00;text-align:center">เว็บสาธิต · สินค้าและผู้ใช้เป็นข้อมูลตัวอย่าง · ไม่มีการสั่งซื้อจริง · ข้อมูลตะกร้าร่วมกันและรีเซ็ตเมื่อรีสตาร์ต</div>', $html, 1); });
