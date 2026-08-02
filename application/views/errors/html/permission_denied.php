<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permission Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }
        .permission-card {
            max-width: 480px;
            margin: 120px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 48px 40px;
            text-align: center;
        }
        .permission-icon {
            font-size: 64px;
            color: #f0ad4e;
            margin-bottom: 20px;
        }
        .permission-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }
        .permission-msg {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 28px;
            line-height: 1.5;
        }
        .btn-back {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background: #1d4ed8;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="permission-card">
        <div class="permission-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <div class="permission-title">Access Restricted</div>
        <div class="permission-msg">
            You don't have permission to access this page.<br>
            Please request your administrator to grant access for this module.
        </div>
        <a href="javascript:history.back()" class="btn-back">
            <i class="bi bi-arrow-left"></i> Go Back
        </a>
    </div>
</body>
</html>
