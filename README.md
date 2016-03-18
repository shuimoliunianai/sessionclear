# sessionclear
the session clear artisan for laravel 5.
## install 
 First your should be sure you computer has installed Compser,if you haven't install it.
please install.the doc is in [This link](http://docs.phpcomposer.com/) to insall Compser.

 after install Composer ,pleaser in your command line to input
   `composer require sessionclear/sessionclear-for-laravel5`. 
## use
 in your laravel project path
  ```php
      'providers' => [
          // ...
          SessionClear\Providers\SessionClearCommand::class,
      ]
  ```
## test
 ```php artisan session:clear
  ```
## end
  if you find any bugs,please send email to me 649591475@qq.com
  thanks give advices to me;
>                                           2016.3.18 Auth by Daozi.
  




