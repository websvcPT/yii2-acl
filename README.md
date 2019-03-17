# yii2-acl
Yii2 Extension to provide management of ACLs for user groups and users. Also allows menu building based on ACL


## Install

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

