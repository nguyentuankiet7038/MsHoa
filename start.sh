#!/bin/bash

# Clear và cache lại các config để tối ưu tốc độ
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Chạy migrate tự động (Không hiển thị prompt xác nhận)
php artisan migrate --force

# Khởi chạy Apache
apache2-foreground
