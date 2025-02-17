# Laravel Notification Service

A customizable notification package for Laravel.

## Installation

Run the following command to install the package:

```sh
composer require kaveh/notification-service
```

## Configuration

1. **Register the Service Provider**  
   Add the following line to `bootstrap/providers.php`:

   ```php
   Kaveh\NotificationService\NotificationServiceProvider::class,
   ```

2. **Update `composer.json`**  
   Add the following to the `autoload` section:

   ```json
   "autoload": {
       "psr-4": {
           "Kaveh\\NotificationService\\": "vendor/kaveh/notification-service/src/"
       }
   }
   ```

   Then, run:

   ```sh
   composer dump-autoload
   ```

3. **Migrate Notification Tables**  
   Run the following command to create necessary database tables:

   ```sh
   php artisan notification:migrate
   ```

4. **Extend the User Model**  
   Replace the default Laravel `Authenticatable` import in your `User` model:

   **Before:**
   ```php
   use Illuminate\Foundation\Auth\User as Authenticatable;
   ```

   **After:**
   ```php
   use Kaveh\NotificationService\Abstracts\Authenticatable;
   ```
   And add this method in your model:
   ```php
   public function getId()
    {
        // TODO: Implement getId() method.
    }
   ```

6. **Notification Configuration**
    - **Notification Type:** Define the notification type, e.g., `user_login`, `order_created`, etc.
    - **Notification Channel:** Specify the notification delivery method: `email`, `sms`, `in-app`, etc.
    - **Notification Preferences:**  
      We recommend using an event-listener to automatically set user notification preferences upon registration. This determines whether a user has granted permission for notifications.

## Usage

### Create a New Notification

Run the following command to generate a notification class:

```sh
php artisan make:notification-service {name}
```

### Send a Notification

To send a notification, use:

```php
NotificationService::sendNotification(notificationClass, UserModel, NotificationType, ?array data = []);
```

Enjoy using `Laravel Notification Service`! 🚀


