# yii2-acl
Yii2 Extension to provide management of ACLs for user groups and users. Also allows menu building based on ACL


## Usage

### Install with Composer
Install package via composer

```bash
composer require websvc/yii2-acl
```

Execute migrations
```bash
./yii migrate/up --migrationPath=@vendor/websvc/yii2-acl/src/migrations
```

**(optional and prefered)** Copy migrations to your migrations folder and execute
```bash
cp vendor/websvc/yii2-acl/src/migrations/* console/migrations/
./yii migrate/up
```

### Update User model

`common\models\User.php`

Update the model definition to reflect the structure change.

### Update User management

Update the user management MVC to use groups.

You can extend the provided model if required:
`websvc\acl\models\Groups.php`

By default there are 3 groups available:

- Developer (level 100)
- Administrator (level 70)
- User (level 50)


### Define a handler for login operations

Add `on afterLogin` handler to perform custom operations after user login

`backend/config/main.php`
```php

    'components' => [
    ...
        'user' => [
            'identityClass' => 'common\models\User',
            'on afterLogin' => ['common\models\User', 'aferloginOperations'],
        ],
    ...
    ],
```

Create new function `User:aferloginOperations`

> This must be public static

`common/models/User.php`
```php
    /**
     * Triggers login operations like logging and ACL loading.
     *
     * This is called as a handler that is defined on config file
     * @return void
     */
    public static function aferloginOperations()
    {
        $user = self::findOne(Yii::$app->user->id);

        $acl = new websvc\acl\Acl();
        $acl->buildUserAclFromGroup($user->group_id);

        // My other awesome afterlogin operations
    }
```


## Requirements

Assumes an existing user table with similar structure as below

**Please note: The schema below is an example** It's not for common use, as
it is a modified version of "default" Yii2 user table structure.

See here a default structure: https://github.com/yiisoft/yii2-app-advanced/blob/master/console/migrations/m130524_201442_init.php

```sql
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `create_user` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Indexes for table `user`
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);


-- AUTO_INCREMENT for table `user`
ALTER TABLE `user` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
```

Migration will add a new column (`group_id`) after existing `status` column.

