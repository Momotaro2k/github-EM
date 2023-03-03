<?php
    //Kết nối tới db
    $host = 'mysql-server'; // tên mysql server
    $user = 'root';
    $pass = 'root';
    $db = 'EMPLOYEE'; // tên databse

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");
    if ($conn->connect_error) 
    {
        die('Cannot connect to the server' . $conn -> connect_error);
    }
    //Tạo db
    $sql = 'CREATE DATABASE IF NOT EXISTS employee';
    
    if (!$conn->query($sql)) {
        die('Cannot create database' . $conn->error);
    }
    //Use db
    $sql = 'USE EMPLOYEE';
    
    if (!$conn->query($sql)) {
        die('Cannot create database' . $conn->error);
    }

    //Tạo table NHANVIEN
    $sql = 'CREATE TABLE IF NOT EXISTS NHANVIEN
    (userName varchar(255) NOT NULL, firstName varchar(255) NOT NULL, lastName varchar(255) NOT NULL, email varchar(255) UNIQUE NOT NULL, pwd varchar(255) NOT NULL, phongBan varchar(255) NOT NULL, chucVu varchar(255) NOT NULL, activated bit(1) default(false), avatar text NOT NULL)';
        if (!$conn->query($sql)) {
            die('Cannot create table' . $conn->error);
        }
    //Tạo table NGHIPHEP
    $sql = 'CREATE TABLE IF NOT EXISTS NGHIPHEP
    (maNP int NOT NULL AUTO_INCREMENT UNIQUE, email varchar(255) DEFAULT NULL, phongBan varchar(255), chucVu varchar(255), total int NOT NULL, start date DEFAULT NULL, end date DEFAULT NULL, reason varchar(255) DEFAULT NULL, status varchar(255) DEFAULT NULL)';
        if (!$conn->query($sql)) {
            die('Cannot create table' . $conn->error);
        }
    //Tạo table PHONGBAN
    $sql = 'CREATE TABLE IF NOT EXISTS PHONGBAN
    (maPB varchar(255) UNIQUE DEFAULT NULL, tenPB varchar(255) UNIQUE DEFAULT NULL, mota varchar(255) DEFAULT NULL)';
        if (!$conn->query($sql)) {
            die('Cannot create table' . $conn->error);
        }
    //Tạo table CONGVIEC
    $sql = 'CREATE TABLE IF NOT EXISTS CONGVIEC
    (maCV int NOT NULL AUTO_INCREMENT UNIQUE, tenCV varchar(255) DEFAULT NULL, maNV varchar(255) DEFAULT NULL, phongBan varchar(255) DEFAULT NULL, start date DEFAULT NULL, end date DEFAULT NULL, mota varchar(255) DEFAULT NULL, mark int DEFAULT NULL, status varchar(255) DEFAULT NULL, file text DEFAULT NULL)';
        if (!$conn->query($sql)) {
            die('Cannot create table' . $conn->error);
        }
?>